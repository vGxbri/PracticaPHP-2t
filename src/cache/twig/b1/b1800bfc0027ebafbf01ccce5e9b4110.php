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

/* components/navTop.html.twig */
class __TwigTemplate_fa7b048bd02172e5ec6c6119f1addd8a extends Template
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
        yield "<nav class=\"navTop\">
    <ul class=\"boxTop-login\">
        ";
        // line 3
        if (($context["usuario"] ?? null)) {
            // line 4
            yield "            <a class=\"boxTop-inside\">
                <div class=\"loggedIn-info\" id=\"loggedIn-info\">
                    <p id=\"userNameTop\">
                        ";
            // line 7
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["usuario"] ?? null), "html", null, true);
            yield "
                    </p>
                    <img src=\"../imgs/profile.png\" id=\"profilePhoto\">
                </div>
            </a>
            <ul class=\"dropDownProfile\" id=\"dropDownProfile\" style=\"display: none\">
                <li class=\"profileOption\">
                    <a href=\"settings.php\">Editar perfil</a>
                </li>
                <li class=\"profileOption\">
                    <a href=\"cerrarSesion.php\">Cerrar sesión</a>
                </li>
            </ul>
        ";
        } else {
            // line 21
            yield "            <a class=\"boxTop-inside\">
                <a id=\"login\">Iniciar sesión</a>
            </a>
        ";
        }
        // line 25
        yield "    </ul>
</nav>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/navTop.html.twig";
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
        return array (  76 => 25,  70 => 21,  53 => 7,  48 => 4,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navTop\">
    <ul class=\"boxTop-login\">
        {% if usuario %}
            <a class=\"boxTop-inside\">
                <div class=\"loggedIn-info\" id=\"loggedIn-info\">
                    <p id=\"userNameTop\">
                        {{ usuario }}
                    </p>
                    <img src=\"../imgs/profile.png\" id=\"profilePhoto\">
                </div>
            </a>
            <ul class=\"dropDownProfile\" id=\"dropDownProfile\" style=\"display: none\">
                <li class=\"profileOption\">
                    <a href=\"settings.php\">Editar perfil</a>
                </li>
                <li class=\"profileOption\">
                    <a href=\"cerrarSesion.php\">Cerrar sesión</a>
                </li>
            </ul>
        {% else %}
            <a class=\"boxTop-inside\">
                <a id=\"login\">Iniciar sesión</a>
            </a>
        {% endif %}
    </ul>
</nav>", "components/navTop.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\components\\navTop.html.twig");
    }
}
