<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* user/profile.html.twig */
class __TwigTemplate_93e5c6a5f9366fd632897d12029de7ac extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "user/profile.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"mainGeneral\">
    ";
        // line 5
        yield from $this->loadTemplate("components/navTop.html.twig", "user/profile.html.twig", 5)->unwrap()->yield(CoreExtension::merge($context, ["usuario" => ($context["usuario"] ?? null)]));
        // line 6
        yield "    
    <div class=\"main\">
        <div class=\"titCanciones\">
            <h1 class=\"titCanciones-inside\">Ajustes</h1>
        </div>
        
        ";
        // line 12
        yield from $this->loadTemplate("user/partials/_profile_form.html.twig", "user/profile.html.twig", 12)->unwrap()->yield($context);
        // line 13
        yield "    </div>
    
    ";
        // line 15
        yield from $this->loadTemplate("components/navBottom.html.twig", "user/profile.html.twig", 15)->unwrap()->yield($context);
        // line 16
        yield "</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user/profile.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  79 => 16,  77 => 15,  73 => 13,  71 => 12,  63 => 6,  61 => 5,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block content %}
<div class=\"mainGeneral\">
    {% include 'components/navTop.html.twig' with {'usuario': usuario} %}
    
    <div class=\"main\">
        <div class=\"titCanciones\">
            <h1 class=\"titCanciones-inside\">Ajustes</h1>
        </div>
        
        {% include 'user/partials/_profile_form.html.twig' %}
    </div>
    
    {% include 'components/navBottom.html.twig' %}
</div>
{% endblock %}", "user/profile.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\user\\profile.html.twig");
    }
}
