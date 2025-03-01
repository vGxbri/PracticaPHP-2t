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

/* home/index.html.twig */
class __TwigTemplate_fbaef9483a7abf57dd556286efce2741 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
    <head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('asset')->getCallable()("css/style.css"), "html", null, true);
        yield "\">
    <title>UrbanMusic</title>
</head>
<body>
";
        // line 11
        yield from $this->loadTemplate("components/navLeft.html.twig", "home/index.html.twig", 11)->unwrap()->yield(CoreExtension::merge($context, ["artista" => ($context["artista"] ?? null)]));
        // line 12
        yield "
<div class=\"mainGeneral\">
    ";
        // line 15
        yield "    ";
        yield from $this->loadTemplate("components/navTop.html.twig", "home/index.html.twig", 15)->unwrap()->yield(CoreExtension::merge($context, ["usuario" => ($context["usuario"] ?? null)]));
        // line 16
        yield "
    <div class=\"main\">
        <div class=\"titCanciones\">
            <h1 class=\"titCanciones-inside\">Canciones</h1>
            <form method=\"GET\" action=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('path')->getCallable()("home"), "html", null, true);
        yield "\" class=\"search-form\">
                <input type=\"text\" name=\"query\" placeholder=\"Buscar canción...\" class=\"search-input\" value=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["query"] ?? null), "html", null, true);
        yield "\">
                    <button type=\"submit\" class=\"search-button\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20px\" height=\"20px\" viewBox=\"0 0 48 48\"><g fill=\"none\" stroke=\"#23cf5f\" stroke-linecap=\"round\" stroke-width=\"4\"><path d=\"m31 31l10 10\"/><circle cx=\"20\" cy=\"20\" r=\"14\"/></g></svg>
                    </button>
            </form>
        </div>

        ";
        // line 28
        if ((array_key_exists("error_addsong", $context) && ($context["error_addsong"] ?? null))) {
            // line 29
            yield "        <p style='color: #cc0000; margin: 0 0 0 12px;'>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error_addsong"] ?? null), "html", null, true);
            yield "</p>
        ";
        }
        // line 31
        yield "
        ";
        // line 32
        if ((array_key_exists("error", $context) && ($context["error"] ?? null))) {
            // line 33
            yield "        <p style='color: #cc0000; margin-left: 12px'>Error: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
        ";
        }
        // line 35
        yield "
        <div class=\"songs\">
            ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["canciones"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["cancion"]) {
            // line 38
            yield "            <div class='songs-inside'>
                <img src='";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "cover", [], "any", false, false, false, 39), "html", null, true);
            yield "' class='cover'>
                    <div class='bottomCover'>
                        <div class='columnLeft'>
                            <h2 class='titSong'>";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "nombre", [], "any", false, false, false, 42), "html", null, true);
            yield "</h2>
                            <p class='artist'>
                                ";
            // line 44
            $context["artistasNombres"] = [];
            // line 45
            yield "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "artistas", [], "any", false, false, false, 45));
            foreach ($context['_seq'] as $context["_key"] => $context["artista"]) {
                // line 46
                yield "                                ";
                $context["artistasNombres"] = Twig\Extension\CoreExtension::merge(($context["artistasNombres"] ?? null), [CoreExtension::getAttribute($this->env, $this->source, $context["artista"], "nombre", [], "any", false, false, false, 46)]);
                // line 47
                yield "                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['artista'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            yield "                                ";
            yield ((($context["artistasNombres"] ?? null)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(($context["artistasNombres"] ?? null), ", "), "html", null, true)) : ("Sin artistas"));
            yield "
                            </p>
                        </div>
                        <div class='columnRight'>
                            <label class='addTo'>
                                <button class='buttonAddTo' onclick=\"guardarCancion('";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "id", [], "any", false, false, false, 53), "html", null, true);
            yield "')\">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' viewBox='0 0 48 48'><g fill='none' stroke='#23cf5f' stroke-linejoin='round' stroke-width='4'><path d='M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z'/><path stroke-linecap='round' d='M24 16v16m-8-8h16'/></g></svg>
                                </button>
                            </label>
                        </div>
                    </div>
            </div>
            ";
            $context['_iterated'] = true;
        }
        // line 60
        if (!$context['_iterated']) {
            // line 61
            yield "            <p>No se encontraron canciones.</p>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cancion'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        yield "        </div>
    </div>

    ";
        // line 67
        yield "    ";
        yield from $this->loadTemplate("components/navBottom.html.twig", "home/index.html.twig", 67)->unwrap()->yield(CoreExtension::merge($context, ["cancionActual" => ($context["cancionActual"] ?? null)]));
        // line 68
        yield "</div>

<script src=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('asset')->getCallable()("js/script.js"), "html", null, true);
        yield "\"></script>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.html.twig";
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
        return array (  185 => 70,  181 => 68,  178 => 67,  173 => 63,  166 => 61,  164 => 60,  152 => 53,  143 => 48,  137 => 47,  134 => 46,  129 => 45,  127 => 44,  122 => 42,  116 => 39,  113 => 38,  108 => 37,  104 => 35,  98 => 33,  96 => 32,  93 => 31,  87 => 29,  85 => 28,  75 => 21,  71 => 20,  65 => 16,  62 => 15,  58 => 12,  56 => 11,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
    <head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"{{ asset('css/style.css') }}\">
    <title>UrbanMusic</title>
</head>
<body>
{# Navegación izquierda #}
{% include 'components/navLeft.html.twig' with {'artista': artista} %}

<div class=\"mainGeneral\">
    {# Navegación superior #}
    {% include 'components/navTop.html.twig' with {'usuario': usuario} %}

    <div class=\"main\">
        <div class=\"titCanciones\">
            <h1 class=\"titCanciones-inside\">Canciones</h1>
            <form method=\"GET\" action=\"{{ path('home') }}\" class=\"search-form\">
                <input type=\"text\" name=\"query\" placeholder=\"Buscar canción...\" class=\"search-input\" value=\"{{ query }}\">
                    <button type=\"submit\" class=\"search-button\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20px\" height=\"20px\" viewBox=\"0 0 48 48\"><g fill=\"none\" stroke=\"#23cf5f\" stroke-linecap=\"round\" stroke-width=\"4\"><path d=\"m31 31l10 10\"/><circle cx=\"20\" cy=\"20\" r=\"14\"/></g></svg>
                    </button>
            </form>
        </div>

        {% if error_addsong is defined and error_addsong %}
        <p style='color: #cc0000; margin: 0 0 0 12px;'>{{ error_addsong }}</p>
        {% endif %}

        {% if error is defined and error %}
        <p style='color: #cc0000; margin-left: 12px'>Error: {{ error }}</p>
        {% endif %}

        <div class=\"songs\">
            {% for cancion in canciones %}
            <div class='songs-inside'>
                <img src='{{ cancion.cover }}' class='cover'>
                    <div class='bottomCover'>
                        <div class='columnLeft'>
                            <h2 class='titSong'>{{ cancion.nombre }}</h2>
                            <p class='artist'>
                                {% set artistasNombres = [] %}
                                {% for artista in cancion.artistas %}
                                {% set artistasNombres = artistasNombres|merge([artista.nombre]) %}
                                {% endfor %}
                                {{ artistasNombres ? artistasNombres|join(', ') : 'Sin artistas' }}
                            </p>
                        </div>
                        <div class='columnRight'>
                            <label class='addTo'>
                                <button class='buttonAddTo' onclick=\"guardarCancion('{{ cancion.id }}')\">
                                    <svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' viewBox='0 0 48 48'><g fill='none' stroke='#23cf5f' stroke-linejoin='round' stroke-width='4'><path d='M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z'/><path stroke-linecap='round' d='M24 16v16m-8-8h16'/></g></svg>
                                </button>
                            </label>
                        </div>
                    </div>
            </div>
            {% else %}
            <p>No se encontraron canciones.</p>
            {% endfor %}
        </div>
    </div>

    {# Navegación inferior #}
    {% include 'components/navBottom.html.twig' with {'cancionActual': cancionActual} %}
</div>

<script src=\"{{ asset('js/script.js') }}\"></script>
</body>
</html>", "home/index.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\home\\index.html.twig");
    }
}
