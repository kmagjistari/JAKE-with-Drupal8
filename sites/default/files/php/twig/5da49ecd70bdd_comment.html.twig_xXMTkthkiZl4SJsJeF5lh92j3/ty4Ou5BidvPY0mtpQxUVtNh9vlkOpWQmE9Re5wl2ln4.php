<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/adaptivetheme/at_core/templates/content/comment.html.twig */
class __TwigTemplate_eef9215650906e3c8f8ac7931de68dbb0ebb084ce31550032bcd616941f0caf1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 68, "if" => 83, "trans" => 95];
        $filters = ["clean_class" => 71, "escape" => 80, "without" => 80];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['clean_class', 'escape', 'without'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 68
        $context["classes"] = [0 => "comment", 1 => "js-comment", 2 => ("comment--type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 71
($context["comment"] ?? null), "bundle", [])))), 3 => ((        // line 72
($context["view_mode"] ?? null)) ? (("comment--view-mode-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : ("")), 4 => (((        // line 73
($context["status"] ?? null) != "published")) ? (($context["status"] ?? null)) : ("")), 5 => (($this->getAttribute($this->getAttribute(        // line 74
($context["comment"] ?? null), "owner", []), "anonymous", [])) ? ("by-anonymous") : ("")), 6 => (((        // line 75
($context["author_id"] ?? null) && (($context["author_id"] ?? null) == $this->getAttribute(($context["commented_entity"] ?? null), "getOwnerId", [], "method")))) ? ((("by-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["commented_entity"] ?? null), "getEntityTypeId", [], "method"))) . "-author")) : ("")), 7 => ((        // line 76
($context["title_visibility"] ?? null)) ? ("has-title") : ("")), 8 => "clearfix"];
        // line 80
        echo "<article role=\"article\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "role"), "html", null, true);
        echo ">
  <div class=\"comment__container\">";
        // line 83
        if (($context["title"] ?? null)) {
            // line 84
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            // line 86
            $context["title_classes"] = [0 => ((            // line 87
($context["title_visibility"] ?? null)) ? ("comment__title") : ("comment__title--visually-hidden")), 1 => "h4"];
            // line 91
            echo "<h3";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method")), "html", null, true);
            echo ">
        ";
            // line 92
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            // line 93
            if ((($context["status"] ?? null) != "published")) {
                // line 94
                echo "<span class=\"comment__status comment--unpublished marker marker--warning\" aria-label=\"Status message\" role=\"contentinfo\">
              <span class=\"visually-hidden\">";
                // line 95
                echo t("This comment is", array());
                echo "</span>";
                echo t("Unpublished", array());
                // line 96
                echo "</span>";
            }
            // line 103
            echo "        <mark class=\"comment__new marker marker--success hidden\" data-comment-timestamp=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["new_indicator_timestamp"] ?? null)), "html", null, true);
            echo "\"></mark>
      </h3>
      ";
            // line 105
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        }
        // line 108
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["meta_attributes"] ?? null)), "html", null, true);
        echo ">
      ";
        // line 109
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_picture"] ?? null)), "html", null, true);
        echo "
      <div";
        // line 110
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["submitted_attributes"] ?? null)), "html", null, true);
        echo ">
        <span class=\"comment__author\">";
        // line 111
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author"] ?? null)), "html", null, true);
        echo "</span>
        <span class=\"comment__pubdate\">";
        // line 112
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["created"] ?? null)), "html", null, true);
        echo "</span>
      </div>
    </div>

    <div";
        // line 116
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => "comment__content"], "method")), "html", null, true);
        echo ">
      ";
        // line 122
        if (($context["parent"] ?? null)) {
            // line 123
            echo "<p class=\"comment__parent visually-hidden\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["parent"] ?? null)), "html", null, true);
            echo "</p>";
        }
        // line 126
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        // line 127
        echo "</div>

  </div>
</article>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/adaptivetheme/at_core/templates/content/comment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 127,  138 => 126,  133 => 123,  131 => 122,  127 => 116,  120 => 112,  116 => 111,  112 => 110,  108 => 109,  103 => 108,  100 => 105,  94 => 103,  91 => 96,  87 => 95,  84 => 94,  82 => 93,  80 => 92,  75 => 91,  73 => 87,  72 => 86,  70 => 84,  68 => 83,  63 => 80,  61 => 76,  60 => 75,  59 => 74,  58 => 73,  57 => 72,  56 => 71,  55 => 68,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/adaptivetheme/at_core/templates/content/comment.html.twig", "C:\\wamp64\\www\\JAKE.local\\themes\\contrib\\adaptivetheme\\at_core\\templates\\content\\comment.html.twig");
    }
}
