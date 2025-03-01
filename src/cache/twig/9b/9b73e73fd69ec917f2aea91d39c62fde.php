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

/* library/library.html.twig */
class __TwigTemplate_058c190141b01820709d990a0c98746c extends Template
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
    <title>Biblioteca | UrbanMusic</title>
</head>
<body>
    ";
        // line 10
        yield from $this->loadTemplate("components/navLeft.html.twig", "library/library.html.twig", 10)->unwrap()->yield(CoreExtension::merge($context, ["artista" => ($context["artista"] ?? null)]));
        // line 11
        yield "
    <div class=\"mainGeneral\">
        ";
        // line 13
        yield from $this->loadTemplate("components/navTop.html.twig", "library/library.html.twig", 13)->unwrap()->yield(CoreExtension::merge($context, ["usuario" => ($context["usuario"] ?? null)]));
        // line 14
        yield "
        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Canciones Guardadas</h1>
            </div>

            ";
        // line 20
        if ( !($context["usuario"] ?? null)) {
            // line 21
            yield "                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a tu biblioteca.</p>
            ";
        } elseif (        // line 22
($context["error"] ?? null)) {
            // line 23
            yield "                <p style=\"color: #cc0000; margin-left: 12px\">Error: ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
            ";
        } else {
            // line 25
            yield "                ";
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["cancionesFavoritas"] ?? null)) > 0)) {
                // line 26
                yield "                    <div class=\"favSongs\">
                        ";
                // line 27
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["cancionesFavoritas"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["cancion"]) {
                    // line 28
                    yield "                            <div class=\"favSongs-inside\">
                                <div class=\"columnLeftFavs\">
                                    <img src=\"";
                    // line 30
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "cover", [], "any", false, false, false, 30), "html", null, true);
                    yield "\" class=\"coverFavs\">
                                    <div class=\"infoFavSongs\">
                                        <h2 class=\"titSongFavs\">";
                    // line 32
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "nombre", [], "any", false, false, false, 32), "html", null, true);
                    yield "</h2>
                                        <p class=\"artistFavs\">
                                            ";
                    // line 34
                    $context["artistasNombres"] = [];
                    // line 35
                    yield "                                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "artistas", [], "any", false, false, false, 35));
                    foreach ($context['_seq'] as $context["_key"] => $context["artista"]) {
                        // line 36
                        yield "                                                ";
                        $context["artistasNombres"] = Twig\Extension\CoreExtension::merge(($context["artistasNombres"] ?? null), [CoreExtension::getAttribute($this->env, $this->source, $context["artista"], "nombre", [], "any", false, false, false, 36)]);
                        // line 37
                        yield "                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['artista'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 38
                    yield "                                            ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(($context["artistasNombres"] ?? null), ", "), "html", null, true);
                    yield "
                                        </p>
                                    </div>
                                </div>
                                <div class=\"columnRightFavs\">
                                    <label class=\"removeFrom\">
                                        <button class=\"buttonRemoveFrom\" onclick=\"eliminarCancionBiblioteca('";
                    // line 44
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "id", [], "any", false, false, false, 44), "html", null, true);
                    yield "')\">
                                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><g id=\"rellenar\" fill=\"white\"><path d=\"M8 11a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z\"/><path fill-rule=\"evenodd\" d=\"M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11m-2 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0\" clip-rule=\"evenodd\"/></g></svg>
                                        </button>
                                    </label>
                                </div>
                            </div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cancion'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                yield "                    </div>
                ";
            } else {
                // line 53
                yield "                    <p style=\"font-weight: bold; color: red; margin-left: 12px\">¡No tienes canciones guardadas!</p>
                ";
            }
            // line 55
            yield "            ";
        }
        // line 56
        yield "        </div>

        ";
        // line 58
        yield from $this->loadTemplate("components/navBottom.html.twig", "library/library.html.twig", 58)->unwrap()->yield(CoreExtension::merge($context, ["cancionActual" => ($context["cancionActual"] ?? null)]));
        // line 59
        yield "    </div>

    <script src=\"";
        // line 61
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
        return "library/library.html.twig";
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
        return array (  169 => 61,  165 => 59,  163 => 58,  159 => 56,  156 => 55,  152 => 53,  148 => 51,  135 => 44,  125 => 38,  119 => 37,  116 => 36,  111 => 35,  109 => 34,  104 => 32,  99 => 30,  95 => 28,  91 => 27,  88 => 26,  85 => 25,  79 => 23,  77 => 22,  74 => 21,  72 => 20,  64 => 14,  62 => 13,  58 => 11,  56 => 10,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"{{ asset('css/style.css') }}\">
    <title>Biblioteca | UrbanMusic</title>
</head>
<body>
    {% include 'components/navLeft.html.twig' with {'artista': artista} %}

    <div class=\"mainGeneral\">
        {% include 'components/navTop.html.twig' with {'usuario': usuario} %}

        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Canciones Guardadas</h1>
            </div>

            {% if not usuario %}
                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a tu biblioteca.</p>
            {% elseif error %}
                <p style=\"color: #cc0000; margin-left: 12px\">Error: {{ error }}</p>
            {% else %}
                {% if cancionesFavoritas|length > 0 %}
                    <div class=\"favSongs\">
                        {% for cancion in cancionesFavoritas %}
                            <div class=\"favSongs-inside\">
                                <div class=\"columnLeftFavs\">
                                    <img src=\"{{ cancion.cover }}\" class=\"coverFavs\">
                                    <div class=\"infoFavSongs\">
                                        <h2 class=\"titSongFavs\">{{ cancion.nombre }}</h2>
                                        <p class=\"artistFavs\">
                                            {% set artistasNombres = [] %}
                                            {% for artista in cancion.artistas %}
                                                {% set artistasNombres = artistasNombres|merge([artista.nombre]) %}
                                            {% endfor %}
                                            {{ artistasNombres|join(', ') }}
                                        </p>
                                    </div>
                                </div>
                                <div class=\"columnRightFavs\">
                                    <label class=\"removeFrom\">
                                        <button class=\"buttonRemoveFrom\" onclick=\"eliminarCancionBiblioteca('{{ cancion.id }}')\">
                                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><g id=\"rellenar\" fill=\"white\"><path d=\"M8 11a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z\"/><path fill-rule=\"evenodd\" d=\"M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11m-2 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0\" clip-rule=\"evenodd\"/></g></svg>
                                        </button>
                                    </label>
                                </div>
                            </div>
                        {% endfor %}
                    </div>
                {% else %}
                    <p style=\"font-weight: bold; color: red; margin-left: 12px\">¡No tienes canciones guardadas!</p>
                {% endif %}
            {% endif %}
        </div>

        {% include 'components/navBottom.html.twig' with {'cancionActual': cancionActual} %}
    </div>

    <script src=\"{{ asset('js/script.js') }}\"></script>
</body>
</html>", "library/library.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\library\\library.html.twig");
    }
}
