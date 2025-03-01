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

/* zona/zonaArtistas.html.twig */
class __TwigTemplate_327ecb69c1201557aefc8354436f26cf extends Template
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
    <title>Zona de Artistas | UrbanMusic</title>
</head>
<body>
    ";
        // line 10
        yield from $this->loadTemplate("components/navLeft.html.twig", "zona/zonaArtistas.html.twig", 10)->unwrap()->yield(CoreExtension::merge($context, ["artista" => ($context["artista"] ?? null)]));
        // line 11
        yield "
    <div class=\"mainGeneral\">
        ";
        // line 13
        yield from $this->loadTemplate("components/navTop.html.twig", "zona/zonaArtistas.html.twig", 13)->unwrap()->yield(CoreExtension::merge($context, ["usuario" => ($context["usuario"] ?? null)]));
        // line 14
        yield "
        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Zona de artistas</h1>
            </div>

            ";
        // line 20
        if ( !($context["usuario"] ?? null)) {
            // line 21
            yield "                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a la zona de artistas.</p>
            ";
        } elseif ( !        // line 22
($context["isArtist"] ?? null)) {
            // line 23
            yield "                <p style=\"color: orange; margin-left: 12px\">El usuario no es un artista</p>
            ";
        } else {
            // line 25
            yield "                <div class=\"botonesCreacionArtistas\">
                    <ul class=\"boxTop-createSong\">
                        <a class=\"boxTop-inside\" id=\"uploadSong\">
                            <div class=\"uploadSong\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"1.2em\" height=\"1.2em\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M10 16h4c.55 0 1-.45 1-1v-5h1.59c.89 0 1.34-1.08.71-1.71L12.71 3.7a.996.996 0 0 0-1.41 0L6.71 8.29c-.63.63-.19 1.71.7 1.71H9v5c0 .55.45 1 1 1m-4 2h12c.55 0 1 .45 1 1s-.45 1-1 1H6c-.55 0-1-.45-1-1s.45-1 1-1\"/></svg>
                                <p id=\"userNameTop\">Subir canción</p>
                            </div>
                        </a>
                    </ul>
                </div>

                <div class=\"titCanciones\">
                    <h2>Canciones subidas</h2>
                </div>

                <div class=\"songs\">
                    ";
            // line 41
            if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["canciones"] ?? null)) > 0)) {
                // line 42
                yield "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["canciones"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["cancion"]) {
                    // line 43
                    yield "                            <div class=\"favSongs-inside\">
                                <div class=\"columnLeftFavs\">
                                    <img src=\"";
                    // line 45
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "cover", [], "any", false, false, false, 45), "html", null, true);
                    yield "\" class=\"coverFavs\">
                                    <div class=\"infoFavSongs\">
                                        <h2 class=\"titSongFavs\">";
                    // line 47
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "nombre", [], "any", false, false, false, 47), "html", null, true);
                    yield "</h2>
                                        <p class=\"artistFavs\">
                                            ";
                    // line 49
                    $context["artistasNombres"] = [];
                    // line 50
                    yield "                                            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "artistas", [], "any", false, false, false, 50));
                    foreach ($context['_seq'] as $context["_key"] => $context["artista"]) {
                        // line 51
                        yield "                                                ";
                        $context["artistasNombres"] = Twig\Extension\CoreExtension::merge(($context["artistasNombres"] ?? null), [CoreExtension::getAttribute($this->env, $this->source, $context["artista"], "nombre", [], "any", false, false, false, 51)]);
                        // line 52
                        yield "                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['artista'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 53
                    yield "                                            ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::join(($context["artistasNombres"] ?? null), ", "), "html", null, true);
                    yield "
                                        </p>
                                    </div>
                                </div>
                                <div class=\"columnRightFavs\">
                                    <label class=\"removeFrom\">
                                        <button class=\"buttonRemoveFrom\" onclick=\"eliminarCancion('";
                    // line 59
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cancion"], "id", [], "any", false, false, false, 59), "html", null, true);
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
                // line 66
                yield "                    ";
            } else {
                // line 67
                yield "                        <p style=\"font-weight: bold; color: red; margin: 0 0 12px 12px\">¡No tienes canciones subidas!</p>
                    ";
            }
            // line 69
            yield "                </div>
            ";
        }
        // line 71
        yield "        </div>

        ";
        // line 73
        yield from $this->loadTemplate("components/navBottom.html.twig", "zona/zonaArtistas.html.twig", 73)->unwrap()->yield(CoreExtension::merge($context, ["cancionActual" => ($context["cancionActual"] ?? null)]));
        // line 74
        yield "    </div>

    ";
        // line 76
        if (($context["isArtist"] ?? null)) {
            // line 77
            yield "        ";
            yield from $this->loadTemplate("components/uploadSongForm.html.twig", "zona/zonaArtistas.html.twig", 77)->unwrap()->yield(CoreExtension::merge($context, ["allArtists" => ($context["allArtists"] ?? null)]));
            // line 78
            yield "    ";
        }
        // line 79
        yield "
    <script src=\"";
        // line 80
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
        return "zona/zonaArtistas.html.twig";
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
        return array (  193 => 80,  190 => 79,  187 => 78,  184 => 77,  182 => 76,  178 => 74,  176 => 73,  172 => 71,  168 => 69,  164 => 67,  161 => 66,  148 => 59,  138 => 53,  132 => 52,  129 => 51,  124 => 50,  122 => 49,  117 => 47,  112 => 45,  108 => 43,  103 => 42,  101 => 41,  83 => 25,  79 => 23,  77 => 22,  74 => 21,  72 => 20,  64 => 14,  62 => 13,  58 => 11,  56 => 10,  49 => 6,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"{{ asset('css/style.css') }}\">
    <title>Zona de Artistas | UrbanMusic</title>
</head>
<body>
    {% include 'components/navLeft.html.twig' with {'artista': artista} %}

    <div class=\"mainGeneral\">
        {% include 'components/navTop.html.twig' with {'usuario': usuario} %}

        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Zona de artistas</h1>
            </div>

            {% if not usuario %}
                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a la zona de artistas.</p>
            {% elseif not isArtist %}
                <p style=\"color: orange; margin-left: 12px\">El usuario no es un artista</p>
            {% else %}
                <div class=\"botonesCreacionArtistas\">
                    <ul class=\"boxTop-createSong\">
                        <a class=\"boxTop-inside\" id=\"uploadSong\">
                            <div class=\"uploadSong\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"1.2em\" height=\"1.2em\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M10 16h4c.55 0 1-.45 1-1v-5h1.59c.89 0 1.34-1.08.71-1.71L12.71 3.7a.996.996 0 0 0-1.41 0L6.71 8.29c-.63.63-.19 1.71.7 1.71H9v5c0 .55.45 1 1 1m-4 2h12c.55 0 1 .45 1 1s-.45 1-1 1H6c-.55 0-1-.45-1-1s.45-1 1-1\"/></svg>
                                <p id=\"userNameTop\">Subir canción</p>
                            </div>
                        </a>
                    </ul>
                </div>

                <div class=\"titCanciones\">
                    <h2>Canciones subidas</h2>
                </div>

                <div class=\"songs\">
                    {% if canciones|length > 0 %}
                        {% for cancion in canciones %}
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
                                        <button class=\"buttonRemoveFrom\" onclick=\"eliminarCancion('{{ cancion.id }}')\">
                                            <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><g id=\"rellenar\" fill=\"white\"><path d=\"M8 11a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2z\"/><path fill-rule=\"evenodd\" d=\"M23 12c0 6.075-4.925 11-11 11S1 18.075 1 12S5.925 1 12 1s11 4.925 11 11m-2 0a9 9 0 1 1-18 0a9 9 0 0 1 18 0\" clip-rule=\"evenodd\"/></g></svg>
                                        </button>
                                    </label>
                                </div>
                            </div>
                        {% endfor %}
                    {% else %}
                        <p style=\"font-weight: bold; color: red; margin: 0 0 12px 12px\">¡No tienes canciones subidas!</p>
                    {% endif %}
                </div>
            {% endif %}
        </div>

        {% include 'components/navBottom.html.twig' with {'cancionActual': cancionActual} %}
    </div>

    {% if isArtist %}
        {% include 'components/uploadSongForm.html.twig' with {'allArtists': allArtists} %}
    {% endif %}

    <script src=\"{{ asset('js/script.js') }}\"></script>
</body>
</html>", "zona/zonaArtistas.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\zona\\zonaArtistas.html.twig");
    }
}
