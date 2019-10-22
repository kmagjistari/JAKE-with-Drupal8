/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Drupal, debounce, CKEDITOR, $, displace, AjaxCommands) {
  Drupal.editors.ckeditor = {
    attach: function attach(element, format) {
      this._loadExternalPlugins(format);

      format.editorSettings.drupal = {
        format: format.format
      };

      var label = $('label[for=' + element.getAttribute('id') + ']').html();
      format.editorSettings.title = Drupal.t('Rich Text Editor, !label field', {
        '!label': label
      });

      return !!CKEDITOR.replace(element, format.editorSettings);
    },
    detach: function detach(element, format, trigger) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        if (trigger === 'serialize') {
          editor.updateElement();
        } else {
          editor.destroy();
          element.removeAttribute('contentEditable');
        }
      }
      return !!editor;
    },
    onChange: function onChange(element, callback) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        editor.on('change', debounce(function () {
          callback(editor.getData());
        }, 400));

        editor.on('mode', function () {
          var editable = editor.editable();
          if (!editable.isInline()) {
            editor.on('autoGrow', function (evt) {
              var doc = evt.editor.document;
              var scrollable = CKEDITOR.env.quirks ? doc.getBody() : doc.getDocumentElement();

              if (scrollable.$.scrollHeight < scrollable.$.clientHeight) {
                scrollable.setStyle('overflow-y', 'hidden');
              } else {
                scrollable.removeStyle('overflow-y');
              }
            }, null, null, 10000);
          }
        });
      }
      return !!editor;
    },
    attachInlineEditor: function attachInlineEditor(element, format, mainToolbarId, floatedToolbarId) {
      this._loadExternalPlugins(format);

      format.editorSettings.drupal = {
        format: format.format
      };

      var settings = $.extend(true, {}, format.editorSettings);

      if (mainToolbarId) {
        var settingsOverride = {
          extraPlugins: 'sharedspace',
          removePlugins: 'floatingspace,elementspath',
          sharedSpaces: {
            top: mainToolbarId
          }
        };

        var sourceButtonFound = false;
        for (var i = 0; !sourceButtonFound && i < settings.toolbar.length; i++) {
          if (settings.toolbar[i] !== '/') {
            for (var j = 0; !sourceButtonFound && j < settings.toolbar[i].items.length; j++) {
              if (settings.toolbar[i].items[j] === 'Source') {
                sourceButtonFound = true;

                settings.toolbar[i].items[j] = 'Sourcedialog';
                settingsOverride.extraPlugins += ',sourcedialog';
                settingsOverride.removePlugins += ',sourcearea';
              }
            }
          }
        }

        settings.extraPlugins += ',' + settingsOverride.extraPlugins;
        settings.removePlugins += ',' + settingsOverride.removePlugins;
        settings.sharedSpaces = settingsOverride.sharedSpaces;
      }

      element.setAttribute('contentEditable', 'true');

      return !!CKEDITOR.inline(element, settings);
    },
    _loadExternalPlugins: function _loadExternalPlugins(format) {
      var externalPlugins = format.editorSettings.drupalExternalPlugins;

      if (externalPlugins) {
        Object.keys(externalPlugins || {}).forEach(function (pluginName) {
          CKEDITOR.plugins.addExternal(pluginName, externalPlugins[pluginName], '');
        });
        delete format.editorSettings.drupalExternalPlugins;
      }
    }
  };

  Drupal.ckeditor = {
    saveCallback: null,

    openDialog: function openDialog(editor, url, existingValues, saveCallback, dialogSettings) {
      var $target = $(editor.container.$);
      if (editor.elementMode === CKEDITOR.ELEMENT_MODE_REPLACE) {
        $target = $target.find('.cke_contents');
      }

      $target.css('position', 'relative').find('.ckeditor-dialog-loading').remove();

      var classes = dialogSettings.dialogClass ? dialogSettings.dialogClass.split(' ') : [];
      classes.push('ui-dialog--narrow');
      dialogSettings.dialogClass = classes.join(' ');
      dialogSettings.autoResize = window.matchMedia('(min-width: 600px)').matches;
      dialogSettings.width = 'auto';

      var $content = $('<div class="ckeditor-dialog-loading"><span style="top: -40px;" class="ckeditor-dialog-loading-link">' + Drupal.t('Loading...') + '</span></div>');
      $content.appendTo($target);

      var ckeditorAjaxDialog = Drupal.ajax({
        dialog: dialogSettings,
        dialogType: 'modal',
        selector: '.ckeditor-dialog-loading-link',
        url: url,
        progress: { type: 'throbber' },
        submit: {
          editor_object: existingValues
        }
      });
      ckeditorAjaxDialog.execute();

      window.setTimeout(function () {
        $content.find('span').animate({ top: '0px' });
      }, 1000);

      Drupal.ckeditor.saveCallback = saveCallback;
    }
  };

  $(window).on('dialogcreate', function (e, dialog, $element, settings) {
    $('.ui-dialog--narrow').css('zIndex', CKEDITOR.config.baseFloatZIndex + 1);
  });

  $(window).on('dialog:beforecreate', function (e, dialog, $element, settings) {
    $('.ckeditor-dialog-loading').animate({ top: '-40px' }, function () {
      $(this).remove();
    });
  });

  $(window).on('editor:dialogsave', function (e, values) {
    if (Drupal.ckeditor.saveCallback) {
      Drupal.ckeditor.saveCallback(values);
    }
  });

  $(window).on('dialog:afterclose', function (e, dialog, $element) {
    if (Drupal.ckeditor.saveCallback) {
      Drupal.ckeditor.saveCallback = null;
    }
  });

  $(document).on('drupalViewportOffsetChange', function () {
    CKEDITOR.config.autoGrow_maxHeight = 0.7 * (window.innerHeight - displace.offsets.top - displace.offsets.bottom);
  });

  function redirectTextareaFragmentToCKEditorInstance() {
    var hash = window.location.hash.substr(1);
    var element = document.getElementById(hash);
    if (element) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        var id = editor.container.getAttribute('id');
        window.location.replace('#' + id);
      }
    }
  }
  $(window).on('hashchange.ckeditor', redirectTextareaFragmentToCKEditorInstance);

  CKEDITOR.config.autoGrow_onStartup = true;

  CKEDITOR.timestamp = drupalSettings.ckeditor.timestamp;

  if (AjaxCommands) {
    AjaxCommands.prototype.ckeditor_add_stylesheet = function (ajax, response, status) {
      var editor = CKEDITOR.instances[response.editor_id];

      if (editor) {
        response.stylesheets.forEach(function (url) {
          editor.document.appendStyleSheet(url);
        });
      }
    };
  }
})(Drupal, Drupal.debounce, CKEDITOR, jQuery, Drupal.displace, Drupal.AjaxCommands);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, CKEDITOR) {
  var convertToOffCanvasCss = function convertToOffCanvasCss(originalCss) {
    var selectorPrefix = '#drupal-off-canvas ';
    var skinPath = '' + CKEDITOR.basePath + CKEDITOR.skinName + '/';
    var css = originalCss.substring(originalCss.indexOf('*/') + 2).trim().replace(/}/g, '}' + selectorPrefix).replace(/,/g, ',' + selectorPrefix).replace(/url\(/g, skinPath);
    return '' + selectorPrefix + css;
  };

  var insertCss = function insertCss(cssToInsert) {
    var offCanvasCss = document.createElement('style');
    offCanvasCss.innerHTML = cssToInsert;
    offCanvasCss.setAttribute('id', 'ckeditor-off-canvas-reset');
    document.body.appendChild(offCanvasCss);
  };

  var addCkeditorOffCanvasCss = function addCkeditorOffCanvasCss() {
    if (document.getElementById('ckeditor-off-canvas-reset')) {
      return;
    }

    CKEDITOR.skinName = CKEDITOR.skin.name;

    var editorCssPath = CKEDITOR.skin.getPath('editor');
    var dialogCssPath = CKEDITOR.skin.getPath('dialog');

    var storedOffCanvasCss = window.localStorage.getItem('Drupal.off-canvas.css.' + editorCssPath + dialogCssPath);

    if (storedOffCanvasCss) {
      insertCss(storedOffCanvasCss);
      return;
    }

    $.when($.get(editorCssPath), $.get(dialogCssPath)).done(function (editorCss, dialogCss) {
      var offCanvasEditorCss = convertToOffCanvasCss(editorCss[0]);
      var offCanvasDialogCss = convertToOffCanvasCss(dialogCss[0]);
      var cssToInsert = '#drupal-off-canvas .cke_inner * {background: transparent;}\n          ' + offCanvasEditorCss + '\n          ' + offCanvasDialogCss;
      insertCss(cssToInsert);

      if (CKEDITOR.timestamp && editorCssPath.indexOf(CKEDITOR.timestamp) !== -1 && dialogCssPath.indexOf(CKEDITOR.timestamp) !== -1) {
        window.localStorage.setItem('Drupal.off-canvas.css.' + editorCssPath + dialogCssPath, cssToInsert);
      }
    });
  };

  addCkeditorOffCanvasCss();
})(jQuery, CKEDITOR);;
/**
 * @file
 * Custom library creating cross-browser support for the JS History API.
 */

/*global Drupal, window*/
/*jslint white:true, this, browser:true*/

Drupal.history = {};

(function (Drupal, window) {
  "use strict";

  Drupal.behaviors.historyApi = {
    attach: function () {
      Drupal.history.push = function (data, title, url) {
        if (window.history && window.history.pushState) {
          window.history.pushState(data, title, url);
        }
      };
    }
  };
}(Drupal, window));

/**
 * Ensures the JavaScript History API works consistently between browsers.
 *
 * @optimize spin this out into a file that is only called on pages that specifically
 * use the History API
 */
(function (window) {
  "use strict";

  // There's nothing to do for older browsers ;)
  if (!window.addEventListener) {
    return;
  }

  var blockPopstateEvent = document.readyState !== "complete";

  window.addEventListener("load", function () {
    // The timeout ensures that popstate-events will be unblocked right
    // after the load event occured, but not in the same event-loop cycle.
    window.setTimeout(function () { blockPopstateEvent = false; }, 0);
  }, false);

  window.addEventListener("popstate", function (evt) {
    if (blockPopstateEvent && document.readyState === "complete") {
      evt.preventDefault();
      evt.stopImmediatePropagation();
    }
  }, false);
}(window));
;
/**
 * @file
 * Adds JavaScript functionality to priveate message threads.
 */

/*global jQuery, Drupal, drupalSettings, window*/
/*jslint white:true, this, browser:true*/

Drupal.PrivateMessages = {};

(function ($, Drupal, drupalSettings, window) {

  "use strict";

  var initialized, threadWrapper, currentThreadId, originalThreadId, loadingPrev, loadingNew, container, timeout, refreshRate, dimmer, loadingThread;

  function triggerCommands(data) {
    var ajaxObject = Drupal.ajax({
      url: "",
      base: false,
      element: false,
      progress: false
    });

    // Trigger any any ajax commands in the response.
    ajaxObject.success(data, "success");
  }

  function showDimmer(callback) {
    if (!dimmer) {
      dimmer = $("<div/>", {id:"private-message-thread-dimmer"}).appendTo(threadWrapper);
    }

    dimmer.fadeTo(500, 0.8, callback);
  }

  function hideDimmer() {
    if (dimmer) {
      dimmer.fadeOut(500);
    }
  }

  var loadPreviousListenerHandler = function (e) {
    e.preventDefault();

    if (!loadingPrev) {
      loadingPrev = true;

      var threadId, oldestId;

      threadId = threadWrapper.children(".private-message-thread:first").attr("data-thread-id");

      container.find(".private-message").each(function () {
        if (!oldestId || Number($(this).attr("data-message-id")) < oldestId) {
          oldestId = Number($(this).attr("data-message-id"));
        }
      });

      $.ajax({
        url:drupalSettings.privateMessageThread.previousMessageCheckUrl,
        data: {threadid:threadId, messageid:oldestId},
        success:function (data) {
          loadingPrev = false;
          triggerCommands(data);
        }
      });
    }
  };

  function loadPreviousListener(context) {
    $(context).find("#load-previous-messages").once("load-previous-private-messages-listener").each(function () {
      $(this).click(loadPreviousListenerHandler);
    });
  }

  function insertNewMessages(messages) {
    var html = $("<div/>").html(messages).contents().css("display", "none");

    if (drupalSettings.privateMessageThread.messageOrder === "asc") {
      html.appendTo(container);
    }
    else {
      html.prependTo(container);
    }

    html.slideDown(300);

    Drupal.attachBehaviors(html[0]);
  }

  function insertPreviousMessages(messages) {
    var html = $("<div/>").html(messages).contents().css("display", "none");

    if (drupalSettings.privateMessageThread.messageOrder === "asc") {
      html.prependTo(container);
    }
    else {
      html.appendTo(container);
    }

    html.slideDown(300);

    Drupal.attachBehaviors(html[0]);
  }

  function getNewMessages() {
    if (!loadingNew) {
      var threadId, newestId = 0;

      loadingNew = true;

      threadId = threadWrapper.children(".private-message-thread:first").attr("data-thread-id");

      container.find(".private-message").each(function () {
        if (Number($(this).attr("data-message-id")) > newestId) {
          newestId = Number($(this).attr("data-message-id"));
        }
      });

      if (refreshRate) {
        $.ajax({
          url:drupalSettings.privateMessageThread.newMessageCheckUrl,
          data: {threadid:threadId, messageid:newestId},
          success:function (data) {
            triggerCommands(data);

            loadingNew = false;

             // Check for new messages again.
            timeout = window.setTimeout(getNewMessages, refreshRate);
          }
        });
      }
    }
  }

  function insertThread(thread) {
    var newThread, originalThread;

    newThread = $("<div/>").html(thread).find(".private-message-thread:first");
    originalThread = threadWrapper.children(".private-message-thread:first");
    Drupal.detachBehaviors(threadWrapper[0]);
    newThread.insertAfter(originalThread);
    originalThread.remove();

    Drupal.attachBehaviors(threadWrapper[0]);

    hideDimmer();
  }

  function loadThread(threadId, pushHistory) {
    if (!loadingThread && threadId !== currentThreadId) {
      loadingThread = true;

      window.clearTimeout(timeout);

      showDimmer();

      $.ajax({
        url:drupalSettings.privateMessageThread.loadThreadUrl,
        data:{id:threadId},
        success:function (data) {
          triggerCommands(data);

          if (Drupal.PrivateMessages.setActiveThread) {
            Drupal.PrivateMessages.setActiveThread(threadId);
          }

          loadingThread = false;

          timeout = window.setTimeout(getNewMessages, refreshRate);
        }
      });

      if (pushHistory) {
        Drupal.history.push({threadId:threadId}, $("title").text(), "/private_messages/" + threadId);
      }
    }
  }

  function init() {
    var loadPreviousButton;

    if (!initialized) {
      initialized = true;

      threadWrapper = $(".private-message-thread").parent();
      refreshRate = drupalSettings.privateMessageThread.refreshRate;
      container = threadWrapper.find(".private-message-thread-messages:first .private-message-wrapper:first").parent();

      loadPreviousButton = $("<div/>", {id:"load-previous-messages-button-wrapper"}).append($("<a/>", {href:"#", id:"load-previous-messages"}).text(Drupal.t("Load Previous")));

      if (drupalSettings.privateMessageThread.messageOrder === "asc") {
        loadPreviousButton.addClass("load-previous-position-before").insertBefore(container);
      }
      else {
        loadPreviousButton.addClass("load-previous-position-after").insertAfter(container);
      }

      originalThreadId = threadWrapper.children(".private-message-thread:first").attr("data-thread-id");

      if (refreshRate) {
        timeout = window.setTimeout(getNewMessages, refreshRate);
      }

      if (Drupal.PrivateMessages.setActiveThread) {
        Drupal.PrivateMessages.setActiveThread(originalThreadId);
      }
    }
  }

  Drupal.behaviors.privateMessageThread = {
    attach:function (context) {
      init();
      loadPreviousListener(context);
      currentThreadId = threadWrapper.children(".private-message-thread:first").attr("data-thread-id");
      container = threadWrapper.find(".private-message-thread-messages:first .private-message-wrapper:first").parent();

      Drupal.AjaxCommands.prototype.insertPrivateMessages = function (ajax, response) {
        // Stifles jSlint warning.
        ajax = ajax;

        if (response.insertType === "new") {
          insertNewMessages(response.messages);
        }
        else {
          if (response.messages) {
            insertPreviousMessages(response.messages);
          }
          else {
            $("#load-previous-messages").parent().slideUp(300, function () {
              $(this).remove();
            });
          }
        }
      };

      Drupal.AjaxCommands.prototype.loadNewPrivateMessages = function () {

        window.clearTimeout(timeout);

        getNewMessages();
      };

      Drupal.AjaxCommands.prototype.privateMessageInsertThread = function (ajax, response) {
        // Stifle jslint warning.
        ajax = ajax;

        if (response.thread && response.thread.length) {
          insertThread(response.thread);
        }
      };

      Drupal.PrivateMessages.loadThread = function (threadId) {
        loadThread(threadId, true);
      };
    },
    detach:function (context) {
      $(context).find("#load-previous-messages").unbind("click", loadPreviousListenerHandler);
    }
  };

  window.onpopstate = function (e) {
    if (e.state&& e.state.threadId) {
      loadThread(e.state.threadId);
    }
    else {
      loadThread(originalThreadId);
    }
  };

}(jQuery, Drupal, drupalSettings, window));
;
!function(i,s,e){"use strict";function t(t,a){var n=i(a);i(e).on("resize.lists",s.debounce(function(s){n.addClass("is-horizontal");var e=n.find(".is-responsive__list"),t=0;e.find(".is-responsive__item").each(function(){t+=i(this).outerWidth(!0)}),1==e.outerWidth(!0)<=t?n.removeClass("is-horizontal").addClass("is-vertical"):n.removeClass("is-vertical").addClass("is-horizontal")},150)).trigger("resize.lists")}s.behaviors.atRL={attach:function(s){var e=i(s).find("[data-at-responsive-list]");e.length&&e.once().each(t)}}}(jQuery,Drupal,window);

!function(t,a,e){"use strict";Drupal.behaviors.atBP={attach:function(t,n){if(a.matchMedia("only screen").matches){var i=n[n.ajaxPageState.theme].at_breakpoints;for(var o in i)i.hasOwnProperty(o)&&function(t,a){enquire.register(a,{match:function(){e.body.classList.add("bp--"+t)},unmatch:function(){e.body.classList.remove("bp--"+t)}})}(o.split("_").join("-"),i[o].mediaquery)}}}}(jQuery,window,document);

/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings) {
  function mapTextContentToAjaxResponse(content) {
    if (content === '') {
      return false;
    }

    try {
      return JSON.parse(content);
    } catch (e) {
      return false;
    }
  }

  function bigPipeProcessPlaceholderReplacement(index, placeholderReplacement) {
    var placeholderId = placeholderReplacement.getAttribute('data-big-pipe-replacement-for-placeholder-with-id');
    var content = this.textContent.trim();

    if (typeof drupalSettings.bigPipePlaceholderIds[placeholderId] !== 'undefined') {
      var response = mapTextContentToAjaxResponse(content);

      if (response === false) {
        $(this).removeOnce('big-pipe');
      } else {
        var ajaxObject = Drupal.ajax({
          url: '',
          base: false,
          element: false,
          progress: false
        });

        ajaxObject.success(response, 'success');
      }
    }
  }

  var interval = drupalSettings.bigPipeInterval || 50;

  var timeoutID = void 0;

  function bigPipeProcessDocument(context) {
    if (!context.querySelector('script[data-big-pipe-event="start"]')) {
      return false;
    }

    $(context).find('script[data-big-pipe-replacement-for-placeholder-with-id]').once('big-pipe').each(bigPipeProcessPlaceholderReplacement);

    if (context.querySelector('script[data-big-pipe-event="stop"]')) {
      if (timeoutID) {
        clearTimeout(timeoutID);
      }
      return true;
    }

    return false;
  }

  function bigPipeProcess() {
    timeoutID = setTimeout(function () {
      if (!bigPipeProcessDocument(document)) {
        bigPipeProcess();
      }
    }, interval);
  }

  bigPipeProcess();

  $(window).on('load', function () {
    if (timeoutID) {
      clearTimeout(timeoutID);
    }
    bigPipeProcessDocument(document);
  });
})(jQuery, Drupal, drupalSettings);;
