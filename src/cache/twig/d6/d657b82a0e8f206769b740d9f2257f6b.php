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

/* user/settings.html.twig */
class __TwigTemplate_6fa39a348ef9ec448a1627390da1f66f extends Template
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
    <link rel=\"stylesheet\" href=\"../css/style.css\">
    <title>Ajustes | UrbanMusic</title>
</head>
<body>
    ";
        // line 10
        yield from $this->loadTemplate("components/navLeft.html.twig", "user/settings.html.twig", 10)->unwrap()->yield(CoreExtension::merge($context, ["artista" => ($context["artista"] ?? null)]));
        // line 11
        yield "    
    <div class=\"mainGeneral\">
        ";
        // line 13
        yield from $this->loadTemplate("components/navTop.html.twig", "user/settings.html.twig", 13)->unwrap()->yield(CoreExtension::merge($context, ["usuario" => ($context["usuario"] ?? null)]));
        // line 14
        yield "        
        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Ajustes</h1>
            </div>
            
            ";
        // line 20
        if ( !($context["usuario"] ?? null)) {
            // line 21
            yield "                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a tus ajustes.</p>
            ";
        } else {
            // line 23
            yield "                <form method=\"POST\" action=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('path')->getCallable()("user_update_username"), "html", null, true);
            yield "\" class=\"formAjustes\">
                    <h2 class=\"titAjustes\">Cambiar el nombre de usuario</h2>
                    <input type=\"text\" class=\"settings-input\" name=\"usuario_nuevo\" placeholder=\"Nuevo nombre de usuario\" required>
                    ";
            // line 26
            if ((array_key_exists("error_settings_user", $context) && ($context["error_settings_user"] ?? null))) {
                // line 27
                yield "                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error_settings_user"] ?? null), "html", null, true);
                yield "</p>
                    ";
            }
            // line 29
            yield "                    <button type=\"submit\" class=\"settings-submit\" name=\"cambiar_usuario\">Confirmar</button>
                </form>

                <form method=\"POST\" action=\"";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('path')->getCallable()("user_update_password"), "html", null, true);
            yield "\" class=\"formAjustes\">
                    <h2 class=\"titAjustes\">Cambia tu contraseña</h2>
                    <input type=\"password\" class=\"settings-input\" name=\"contrasena_actual\" placeholder=\"Contraseña actual\" required>
                    <input type=\"password\" class=\"settings-input\" name=\"nueva_contrasena\" placeholder=\"Nueva contraseña\" required>
                    <input type=\"password\" class=\"settings-input\" name=\"nueva_contrasena_confirmar\" placeholder=\"Repite la nueva contraseña\" required>
                    ";
            // line 37
            if ((array_key_exists("error_settings_pass", $context) && ($context["error_settings_pass"] ?? null))) {
                // line 38
                yield "                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error_settings_pass"] ?? null), "html", null, true);
                yield "</p>
                    ";
            }
            // line 40
            yield "                    <button type=\"submit\" class=\"settings-submit\" name=\"cambiar_contrasena\">Confirmar</button>
                </form>

                <form method=\"POST\" action=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('path')->getCallable()("user_delete_account"), "html", null, true);
            yield "\" class=\"formAjustes-eliminarCuenta\">
                    ";
            // line 44
            if ((array_key_exists("error_settings_delete", $context) && ($context["error_settings_delete"] ?? null))) {
                // line 45
                yield "                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error_settings_delete"] ?? null), "html", null, true);
                yield "</p>
                    ";
            }
            // line 47
            yield "                    <button type=\"submit\" class=\"settings-submit-delete\" name=\"eliminar_cuenta\">Eliminar cuenta</button>
                </form>
            ";
        }
        // line 50
        yield "        </div>
        
        ";
        // line 52
        yield from $this->loadTemplate("components/navBottom.html.twig", "user/settings.html.twig", 52)->unwrap()->yield($context);
        // line 53
        yield "    </div>

    <script src=\"../js/script.js\"></script>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user/settings.html.twig";
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
        return array (  139 => 53,  137 => 52,  133 => 50,  128 => 47,  122 => 45,  120 => 44,  116 => 43,  111 => 40,  105 => 38,  103 => 37,  95 => 32,  90 => 29,  84 => 27,  82 => 26,  75 => 23,  71 => 21,  69 => 20,  61 => 14,  59 => 13,  55 => 11,  53 => 10,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" href=\"../css/style.css\">
    <title>Ajustes | UrbanMusic</title>
</head>
<body>
    {% include 'components/navLeft.html.twig' with {'artista': artista} %}
    
    <div class=\"mainGeneral\">
        {% include 'components/navTop.html.twig' with {'usuario': usuario} %}
        
        <div class=\"main\">
            <div class=\"titCanciones\">
                <h1 class=\"titCanciones-inside\">Ajustes</h1>
            </div>
            
            {% if not usuario %}
                <p style=\"font-weight: bold; color: #cc0000; margin-left: 12px\">Necesitas iniciar sesión para acceder a tus ajustes.</p>
            {% else %}
                <form method=\"POST\" action=\"{{ path('user_update_username') }}\" class=\"formAjustes\">
                    <h2 class=\"titAjustes\">Cambiar el nombre de usuario</h2>
                    <input type=\"text\" class=\"settings-input\" name=\"usuario_nuevo\" placeholder=\"Nuevo nombre de usuario\" required>
                    {% if error_settings_user is defined and error_settings_user %}
                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">{{ error_settings_user }}</p>
                    {% endif %}
                    <button type=\"submit\" class=\"settings-submit\" name=\"cambiar_usuario\">Confirmar</button>
                </form>

                <form method=\"POST\" action=\"{{ path('user_update_password') }}\" class=\"formAjustes\">
                    <h2 class=\"titAjustes\">Cambia tu contraseña</h2>
                    <input type=\"password\" class=\"settings-input\" name=\"contrasena_actual\" placeholder=\"Contraseña actual\" required>
                    <input type=\"password\" class=\"settings-input\" name=\"nueva_contrasena\" placeholder=\"Nueva contraseña\" required>
                    <input type=\"password\" class=\"settings-input\" name=\"nueva_contrasena_confirmar\" placeholder=\"Repite la nueva contraseña\" required>
                    {% if error_settings_pass is defined and error_settings_pass %}
                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">{{ error_settings_pass }}</p>
                    {% endif %}
                    <button type=\"submit\" class=\"settings-submit\" name=\"cambiar_contrasena\">Confirmar</button>
                </form>

                <form method=\"POST\" action=\"{{ path('user_delete_account') }}\" class=\"formAjustes-eliminarCuenta\">
                    {% if error_settings_delete is defined and error_settings_delete %}
                        <p style=\"color: #cc0000; display: flex; justify-content: center; margin-top: 0;\">{{ error_settings_delete }}</p>
                    {% endif %}
                    <button type=\"submit\" class=\"settings-submit-delete\" name=\"eliminar_cuenta\">Eliminar cuenta</button>
                </form>
            {% endif %}
        </div>
        
        {% include 'components/navBottom.html.twig' %}
    </div>

    <script src=\"../js/script.js\"></script>
</body>
</html>", "user/settings.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\user\\settings.html.twig");
    }
}
