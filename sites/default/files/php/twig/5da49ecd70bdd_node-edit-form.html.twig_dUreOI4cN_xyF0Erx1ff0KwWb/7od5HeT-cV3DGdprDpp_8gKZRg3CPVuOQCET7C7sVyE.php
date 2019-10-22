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

/* themes/contrib/adaptivetheme/at_core/templates/content-edit/node-edit-form.html.twig */
class __TwigTemplate_812f6c587678df021f852b1250119ebf627ba9c366b9a92127b2c8aa6ecff07e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 21, "without" => 26];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'without'],
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
        // line 19
        echo "<div data-at-responsive-columns>
  <div class=\"layout-region\">
    <h1 class=\"page__title h2\">";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
        echo "</h1>
  </div>
  <div class=\"layout-node-form clearfix is-responsive__layout\">
    <div class=\"layout-region layout-region-node-main is-responsive__column\">
      <div class=\"layout-region__inner layout-region-node-main__inner\">
       ";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null)), "advanced", "actions"), "html", null, true);
        echo "
      </div>
    </div>
    <div class=\"layout-region layout-region-node-secondary is-responsive__column\">
      <div class=\"layout-region__inner layout-region-node-secondary__inner\">
        ";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "advanced", [])), "html", null, true);
        echo "
      </div>
    </div>
  </div>
</div>
<div class=\"layout-node-form-footer clearfix\">
  <div class=\"layout-region layout-region-node-footer\">
    <div class=\"layout-region__inner layout-region-node-footer__inner\">
      ";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "actions", [])), "html", null, true);
        echo "
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/adaptivetheme/at_core/templates/content-edit/node-edit-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 39,  75 => 31,  67 => 26,  59 => 21,  55 => 19,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/adaptivetheme/at_core/templates/content-edit/node-edit-form.html.twig", "C:\\wamp64\\www\\JAKE.local\\themes\\contrib\\adaptivetheme\\at_core\\templates\\content-edit\\node-edit-form.html.twig");
    }
}
