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

/* themes/contrib/adaptivetheme/at_core/templates/user/user.html.twig */
class __TwigTemplate_1d4affd841ac6f1e975e59526dc57ac079834e43e66721806e401994984d4792 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 24, "if" => 35, "trans" => 37];
        $filters = ["join" => 28, "clean_class" => 30, "escape" => 33, "without" => 33];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['join', 'clean_class', 'escape', 'without'],
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
        // line 24
        $context["classes"] = [0 => "user", 1 => "user--profile", 2 => ("user--id-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 27
($context["user"] ?? null), "id", []))), 3 => ((        // line 28
($context["roles"] ?? null)) ? (twig_join_filter($this->sandbox->ensureToStringAllowed(($context["roles"] ?? null)), " ")) : ("")), 4 => (($this->getAttribute(        // line 29
($context["user"] ?? null), "isBlocked", [], "method")) ? ("user--is-blocked") : ("user--is-active")), 5 => ((        // line 30
($context["view_mode"] ?? null)) ? (("user--view-mode-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : (""))];
        // line 33
        echo "<article";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method"), "setAttribute", [0 => "role", 1 => "article"], "method")), "id"), "html", null, true);
        echo ">";
        // line 35
        if ($this->getAttribute(($context["user"] ?? null), "isBlocked", [], "method")) {
            // line 36
            echo "<span class=\"user__status user--is-blocked marker marker--warning\" aria-label=\"Status message\" role=\"contentinfo\">
      <span class=\"visually-hidden\">";
            // line 37
            echo t("This user is", array());
            echo "</span>";
            echo t("Blocked", array());
            // line 38
            echo "</span>";
        }
        // line 41
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
        // line 42
        if (($context["label"] ?? null)) {
            // line 43
            if ((($context["view_mode"] ?? null) == "full")) {
                // line 44
                echo "<h1";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => "user__title"], "method")), "html", null, true);
                echo ">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
                echo "</h1>";
            } else {
                // line 46
                echo "<h2";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => "user__title"], "method")), "html", null, true);
                echo ">";
                // line 47
                if (($context["access_profiles"] ?? null)) {
                    // line 48
                    echo "<a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
                    echo "user/";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["user"] ?? null), "id", [])), "html", null, true);
                    echo "\" class=\"user__title-link\" rel=\"bookmark\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
                    echo "</a>";
                } else {
                    // line 50
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
                }
                // line 52
                echo "</h2>";
            }
        }
        // line 55
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        // line 57
        if (($context["content"] ?? null)) {
            // line 58
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        }
        // line 61
        echo "</article>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/adaptivetheme/at_core/templates/user/user.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 61,  116 => 58,  114 => 57,  112 => 55,  108 => 52,  105 => 50,  96 => 48,  94 => 47,  90 => 46,  83 => 44,  81 => 43,  79 => 42,  77 => 41,  74 => 38,  70 => 37,  67 => 36,  65 => 35,  61 => 33,  59 => 30,  58 => 29,  57 => 28,  56 => 27,  55 => 24,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/adaptivetheme/at_core/templates/user/user.html.twig", "C:\\wamp64\\www\\JAKE.local\\themes\\contrib\\adaptivetheme\\at_core\\templates\\user\\user.html.twig");
    }
}
