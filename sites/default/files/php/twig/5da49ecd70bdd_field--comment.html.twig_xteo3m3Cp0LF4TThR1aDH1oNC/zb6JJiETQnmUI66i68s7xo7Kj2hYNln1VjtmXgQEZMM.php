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

/* themes/contrib/adaptivetheme/at_core/templates/field/field--comment.html.twig */
class __TwigTemplate_9259b8baa54aac75642b0f99fd959331c9835bb4061daad31c2fe72bb5bdf256 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 28, "if" => 52];
        $filters = ["clean_class" => 28, "escape" => 50, "t" => 62];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape', 't'],
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
        // line 28
        $context["field_name_class"] = \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_name"] ?? null)));
        // line 30
        $context["classes"] = [0 => "field", 1 => ((("field-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 32
($context["entity_type"] ?? null)))) . "--") . $this->sandbox->ensureToStringAllowed(($context["field_name_class"] ?? null))), 2 => ((        // line 33
($context["field_formatter"] ?? null)) ? (("field-formatter-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_formatter"] ?? null))))) : ("")), 3 => ("field-name-" . $this->sandbox->ensureToStringAllowed(        // line 34
($context["field_name_class"] ?? null))), 4 => ("field-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 35
($context["field_type"] ?? null)))), 5 => ("field-label-" . $this->sandbox->ensureToStringAllowed(        // line 36
($context["label_display"] ?? null))), 6 => (((        // line 37
($context["label_display"] ?? null) == "inline")) ? ("clearfix") : ("")), 7 => ((        // line 38
($context["comment_display_mode"] ?? null)) ? ("display-mode-threaded") : ("")), 8 => ((        // line 39
($context["comment_type"] ?? null)) ? (("comment-bundle-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["comment_type"] ?? null))))) : ("")), 9 => "comment-wrapper"];
        // line 44
        $context["title_classes"] = [0 => "comment-field__title", 1 => "h3", 2 => (((        // line 47
($context["label_display"] ?? null) == "visually_hidden")) ? ("visually-hidden") : (""))];
        // line 50
        echo "<section";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  <a name=\"comments\"></a>";
        // line 52
        if (($this->getAttribute(($context["comments"] ?? null), "pager", []) &&  !($context["label_hidden"] ?? null))) {
            // line 53
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            echo "
    <h2";
            // line 54
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</h2>
    ";
            // line 55
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        }
        // line 58
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comments"] ?? null)), "html", null, true);
        // line 60
        if (($context["comment_form"] ?? null)) {
            // line 61
            echo "<div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => "comment-form-wrapper"], "method")), "html", null, true);
            echo ">
      <h2 class=\"comment-form__title h3\">";
            // line 62
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Add new comment"));
            echo "</h2>";
            // line 63
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comment_form"] ?? null)), "html", null, true);
            // line 64
            echo "</div>";
        }
        // line 66
        echo "</section>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/adaptivetheme/at_core/templates/field/field--comment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 66,  104 => 64,  102 => 63,  99 => 62,  94 => 61,  92 => 60,  90 => 58,  87 => 55,  81 => 54,  77 => 53,  75 => 52,  70 => 50,  68 => 47,  67 => 44,  65 => 39,  64 => 38,  63 => 37,  62 => 36,  61 => 35,  60 => 34,  59 => 33,  58 => 32,  57 => 30,  55 => 28,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/adaptivetheme/at_core/templates/field/field--comment.html.twig", "C:\\wamp64\\www\\JAKE.local\\themes\\contrib\\adaptivetheme\\at_core\\templates\\field\\field--comment.html.twig");
    }
}
