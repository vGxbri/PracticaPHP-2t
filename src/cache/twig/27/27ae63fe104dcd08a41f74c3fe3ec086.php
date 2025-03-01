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

/* components/uploadSongForm.html.twig */
class __TwigTemplate_aa9b36749c1219aac875eb3d43d82b99 extends Template
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
        yield "<div class=\"formulario-cancion-div\" id=\"uploadSongForm\" ";
        if ((array_key_exists("error_uploadsong", $context) && ($context["error_uploadsong"] ?? null))) {
            yield "style=\"display: flex\"";
        } else {
            yield "style=\"display: none\"";
        }
        yield ">
    <form class=\"formulario-cancion\" method=\"POST\" enctype=\"multipart/form-data\">
        <a id=\"exitFormUploadSong\">
            <svg id=\"exitFormIcon\" xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 15 15\">
                <path fill=\"#23cf5f\" d=\"M3.64 2.27L7.5 6.13l3.84-3.84A.92.92 0 0 1 12 2a1 1 0 0 1 1 1a.9.9 0 0 1-.27.66L8.84 7.5l3.89 3.89A.9.9 0 0 1 13 12a1 1 0 0 1-1 1a.92.92 0 0 1-.69-.27L7.5 8.87l-3.85 3.85A.92.92 0 0 1 3 13a1 1 0 0 1-1-1a.9.9 0 0 1 .27-.66L6.16 7.5L2.27 3.61A.9.9 0 0 1 2 3a1 1 0 0 1 1-1c.24.003.47.1.64.27\"/>
            </svg>
        </a>
        <h2 class=\"formulario-cancion-tit\">Subir Canción</h2>
        <div>
            <label for=\"nombreCancion\">Nombre de la canción:</label>
            <input type=\"text\" id=\"nombreCancion\" name=\"nombreCancion\" required>
        </div>

        <div>
            <label for=\"duracion\">Duración de la canción (en segundos):</label>
            <input type=\"number\" id=\"duracion\" name=\"duracion\" min=\"1\" required>
        </div>

        <div>
            <label for=\"artistas\">Artistas:</label>
            <select id=\"artistas\" name=\"artistas[]\" multiple required>
                ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["allArtists"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["artista"]) {
            // line 23
            yield "                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["artista"], "nombre", [], "any", false, false, false, 23), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["artista"], "nombre", [], "any", false, false, false, 23), "html", null, true);
            yield "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['artista'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "            </select>
        </div>

        <div>
            <label for=\"fechaEstreno\">Fecha de estreno (DD/MM/YYYY):</label>
            <input type=\"text\" id=\"fechaEstreno\" name=\"fechaEstreno\" required>
        </div>

        <div>
            <label for=\"cover\">Cover de la canción:</label>
            <input type=\"file\" id=\"cover\" name=\"cover\" accept=\"image/*\" required>
        </div>

        ";
        // line 38
        if (array_key_exists("error_uploadsong", $context)) {
            // line 39
            yield "            <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error_uploadsong"] ?? null), "html", null, true);
            yield "</p>
        ";
        }
        // line 41
        yield "
        <button type=\"submit\" name=\"subir_cancion\">Subir Canción</button>
    </form>
</div>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/uploadSongForm.html.twig";
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
        return array (  109 => 41,  103 => 39,  101 => 38,  86 => 25,  75 => 23,  71 => 22,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"formulario-cancion-div\" id=\"uploadSongForm\" {% if error_uploadsong is defined and error_uploadsong %}style=\"display: flex\"{% else %}style=\"display: none\"{% endif %}>
    <form class=\"formulario-cancion\" method=\"POST\" enctype=\"multipart/form-data\">
        <a id=\"exitFormUploadSong\">
            <svg id=\"exitFormIcon\" xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 15 15\">
                <path fill=\"#23cf5f\" d=\"M3.64 2.27L7.5 6.13l3.84-3.84A.92.92 0 0 1 12 2a1 1 0 0 1 1 1a.9.9 0 0 1-.27.66L8.84 7.5l3.89 3.89A.9.9 0 0 1 13 12a1 1 0 0 1-1 1a.92.92 0 0 1-.69-.27L7.5 8.87l-3.85 3.85A.92.92 0 0 1 3 13a1 1 0 0 1-1-1a.9.9 0 0 1 .27-.66L6.16 7.5L2.27 3.61A.9.9 0 0 1 2 3a1 1 0 0 1 1-1c.24.003.47.1.64.27\"/>
            </svg>
        </a>
        <h2 class=\"formulario-cancion-tit\">Subir Canción</h2>
        <div>
            <label for=\"nombreCancion\">Nombre de la canción:</label>
            <input type=\"text\" id=\"nombreCancion\" name=\"nombreCancion\" required>
        </div>

        <div>
            <label for=\"duracion\">Duración de la canción (en segundos):</label>
            <input type=\"number\" id=\"duracion\" name=\"duracion\" min=\"1\" required>
        </div>

        <div>
            <label for=\"artistas\">Artistas:</label>
            <select id=\"artistas\" name=\"artistas[]\" multiple required>
                {% for artista in allArtists %}
                    <option value=\"{{ artista.nombre }}\">{{ artista.nombre }}</option>
                {% endfor %}
            </select>
        </div>

        <div>
            <label for=\"fechaEstreno\">Fecha de estreno (DD/MM/YYYY):</label>
            <input type=\"text\" id=\"fechaEstreno\" name=\"fechaEstreno\" required>
        </div>

        <div>
            <label for=\"cover\">Cover de la canción:</label>
            <input type=\"file\" id=\"cover\" name=\"cover\" accept=\"image/*\" required>
        </div>

        {% if error_uploadsong is defined %}
            <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">{{ error_uploadsong }}</p>
        {% endif %}

        <button type=\"submit\" name=\"subir_cancion\">Subir Canción</button>
    </form>
</div>", "components/uploadSongForm.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\components\\uploadSongForm.html.twig");
    }
}
