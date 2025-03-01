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

/* mainLibrary.html.twig */
class __TwigTemplate_eba7aebef3d7a76e3157ad66f097dd3e extends Template
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
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layouts/base.html.twig", "mainLibrary.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Biblioteca | Spotify";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "    <div class=\"library-container\">
        ";
        // line 7
        if (($context["usuario"] ?? null)) {
            // line 8
            yield "            <h2>Biblioteca de ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["usuario"] ?? null), "user", [], "any", false, false, false, 8), "html", null, true);
            yield "</h2>
            ";
            // line 9
            if (($context["cancionesFavoritas"] ?? null)) {
                // line 10
                yield "                <div class=\"favorites-list\">
                    ";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["cancionesFavoritas"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["cancion"]) {
                    // line 12
                    yield "                        <div class=\"song-item\">
                            <h3>";
                    // line 13
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "titulo", [], "any", false, false, false, 13), "html", null, true);
                    yield "</h3>
                            <p>";
                    // line 14
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "artista", [], "any", false, false, false, 14), "nombre", [], "any", false, false, false, 14), "html", null, true);
                    yield "</p>
                        </div>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cancion'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 17
                yield "                </div>
            ";
            } else {
                // line 19
                yield "                <p>No tienes canciones favoritas aún.</p>
            ";
            }
            // line 21
            yield "        ";
        }
        // line 22
        yield "    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "mainLibrary.html.twig";
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
        return array (  116 => 22,  113 => 21,  109 => 19,  105 => 17,  96 => 14,  92 => 13,  89 => 12,  85 => 11,  82 => 10,  80 => 9,  75 => 8,  73 => 7,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layouts/base.html.twig\" %}

{% block title %}Biblioteca | Spotify{% endblock %}

{% block content %}
    <div class=\"library-container\">
        {% if usuario %}
            <h2>Biblioteca de {{ usuario.user }}</h2>
            {% if cancionesFavoritas %}
                <div class=\"favorites-list\">
                    {% for cancion in cancionesFavoritas %}
                        <div class=\"song-item\">
                            <h3>{{ cancion.titulo }}</h3>
                            <p>{{ cancion.artista.nombre }}</p>
                        </div>
                    {% endfor %}
                </div>
            {% else %}
                <p>No tienes canciones favoritas aún.</p>
            {% endif %}
        {% endif %}
    </div>
{% endblock %}", "mainLibrary.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\mainLibrary.html.twig");
    }
}
