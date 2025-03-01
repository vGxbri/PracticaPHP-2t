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

/* components/navLeft.html.twig */
class __TwigTemplate_b9765b1886a87cfbb44340c951f8c0f5 extends Template
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
        yield "<nav class=\"navLeft\">
    <ul class=\"box\">
        <a class=\"box-inside\" href=\"index.php\">
            <img id=\"imgHome\" class=\"icons\" src=\"../imgs/home.png\" alt=\"Principal\">
            <img class=\"icons\" src=\"../imgs/home-filled.png\" alt=\"Principal\">
            <span class=\"textIcons\">Principal</span>
        </a>
    </ul>
    <ul class=\"box\">
        <a class=\"box-inside\" href=\"library.php\">
            <img id=\"imgLibrary\" class=\"icons\" src=\"../imgs/library.png\" alt=\"Biblioteca\">
            <img class=\"icons\" src=\"../imgs/library-filled.png\" alt=\"Biblioteca\">
            <span class=\"textIcons\">Biblioteca</span>
        </a>
    </ul>
    ";
        // line 16
        if (($context["artista"] ?? null)) {
            // line 17
            yield "        <ul class=\"box\">
            <a class=\"box-inside\" href=\"zonaArtistas.php\">
                <img id=\"imgArtists\" class=\"icons\" src=\"../imgs/artist.png\" alt=\"zonaArtistas\">
                <img class=\"icons\" src=\"../imgs/artist-filled.png\" alt=\"Ajustes\">
                <span class=\"textIcons\">Zona de Artistas</span>
            </a>
        </ul>
    ";
        }
        // line 25
        yield "    <ul class=\"box\">
        <a class=\"box-inside\" href=\"settings.php\">
            <img id=\"imgSettings\" class=\"icons\" src=\"../imgs/settings.png\" alt=\"Ajustes\">
            <img class=\"icons\" src=\"../imgs/settings-filled.png\" alt=\"Ajustes\">
            <span class=\"textIcons\">Ajustes</span>
        </a>
    </ul>
</nav>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/navLeft.html.twig";
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
        return array (  71 => 25,  61 => 17,  59 => 16,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navLeft\">
    <ul class=\"box\">
        <a class=\"box-inside\" href=\"index.php\">
            <img id=\"imgHome\" class=\"icons\" src=\"../imgs/home.png\" alt=\"Principal\">
            <img class=\"icons\" src=\"../imgs/home-filled.png\" alt=\"Principal\">
            <span class=\"textIcons\">Principal</span>
        </a>
    </ul>
    <ul class=\"box\">
        <a class=\"box-inside\" href=\"library.php\">
            <img id=\"imgLibrary\" class=\"icons\" src=\"../imgs/library.png\" alt=\"Biblioteca\">
            <img class=\"icons\" src=\"../imgs/library-filled.png\" alt=\"Biblioteca\">
            <span class=\"textIcons\">Biblioteca</span>
        </a>
    </ul>
    {% if artista %}
        <ul class=\"box\">
            <a class=\"box-inside\" href=\"zonaArtistas.php\">
                <img id=\"imgArtists\" class=\"icons\" src=\"../imgs/artist.png\" alt=\"zonaArtistas\">
                <img class=\"icons\" src=\"../imgs/artist-filled.png\" alt=\"Ajustes\">
                <span class=\"textIcons\">Zona de Artistas</span>
            </a>
        </ul>
    {% endif %}
    <ul class=\"box\">
        <a class=\"box-inside\" href=\"settings.php\">
            <img id=\"imgSettings\" class=\"icons\" src=\"../imgs/settings.png\" alt=\"Ajustes\">
            <img class=\"icons\" src=\"../imgs/settings-filled.png\" alt=\"Ajustes\">
            <span class=\"textIcons\">Ajustes</span>
        </a>
    </ul>
</nav>", "components/navLeft.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\components\\navLeft.html.twig");
    }
}
