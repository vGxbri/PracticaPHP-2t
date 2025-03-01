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

/* components/navBottom.html.twig */
class __TwigTemplate_dd27ca7e4758512d9d6bc180394a8d68 extends Template
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
        yield "<nav class=\"navBottom\">
    <div class=\"navBottom1\">
        <div class=\"coverBot\"><img src=\"../imgs/covers/quienesdeiv.jpeg\" class=\"coverBot-inside\"></div>
        <div class=\"controls\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M19 7.766c0-1.554-1.696-2.515-3.029-1.715l-7.056 4.234c-1.295.777-1.295 2.653 0 3.43l7.056 4.234c1.333.8 3.029-.16 3.029-1.715zM9.944 12L17 7.766v8.468zM6 6a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1\"/></svg>
            <img src=\"../imgs/play.png\" id=\"reanudar\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M5 7.766c0-1.554 1.696-2.515 3.029-1.715l7.056 4.234c1.295.777 1.295 2.653 0 3.43L8.03 17.949c-1.333.8-3.029-.16-3.029-1.715zM14.056 12L7 7.766v8.468zM18 6a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1\"/></svg>
        </div>
        <div class=\"volume\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" aria-hidden=\"true\" width=\"30px\" height=\"30px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M5.003 11.716c.038-1.843.057-2.764.678-3.552c.113-.144.28-.315.42-.431c.763-.636 1.771-.636 3.788-.636c.72 0 1.081 0 1.425-.092q.107-.03.211-.067c.336-.121.637-.33 1.238-.746c2.374-1.645 3.56-2.467 4.557-2.11c.191.069.376.168.541.29c.861.635.927 2.115 1.058 5.073C18.967 10.541 19 11.48 19 12s-.033 1.46-.081 2.555c-.131 2.958-.197 4.438-1.058 5.073a2.2 2.2 0 0 1-.54.29c-.997.357-2.184-.465-4.558-2.11c-.601-.416-.902-.625-1.238-.746a3 3 0 0 0-.211-.067c-.344-.092-.704-.092-1.425-.092c-2.017 0-3.025 0-3.789-.636a3 3 0 0 1-.419-.43c-.621-.79-.64-1.71-.678-3.552a14 14 0 0 1 0-.57\"/></svg>
            <input type=\"range\">
        </div>
    </div>
    <div class=\"navBottom2\">
        <div class=\"songLength\"></div>
    </div>
</nav>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/navBottom.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"navBottom\">
    <div class=\"navBottom1\">
        <div class=\"coverBot\"><img src=\"../imgs/covers/quienesdeiv.jpeg\" class=\"coverBot-inside\"></div>
        <div class=\"controls\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M19 7.766c0-1.554-1.696-2.515-3.029-1.715l-7.056 4.234c-1.295.777-1.295 2.653 0 3.43l7.056 4.234c1.333.8 3.029-.16 3.029-1.715zM9.944 12L17 7.766v8.468zM6 6a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1\"/></svg>
            <img src=\"../imgs/play.png\" id=\"reanudar\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40px\" height=\"40px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M5 7.766c0-1.554 1.696-2.515 3.029-1.715l7.056 4.234c1.295.777 1.295 2.653 0 3.43L8.03 17.949c-1.333.8-3.029-.16-3.029-1.715zM14.056 12L7 7.766v8.468zM18 6a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0V7a1 1 0 0 1 1-1\"/></svg>
        </div>
        <div class=\"volume\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" aria-hidden=\"true\" width=\"30px\" height=\"30px\" viewBox=\"0 0 24 24\"><path fill=\"white\" d=\"M5.003 11.716c.038-1.843.057-2.764.678-3.552c.113-.144.28-.315.42-.431c.763-.636 1.771-.636 3.788-.636c.72 0 1.081 0 1.425-.092q.107-.03.211-.067c.336-.121.637-.33 1.238-.746c2.374-1.645 3.56-2.467 4.557-2.11c.191.069.376.168.541.29c.861.635.927 2.115 1.058 5.073C18.967 10.541 19 11.48 19 12s-.033 1.46-.081 2.555c-.131 2.958-.197 4.438-1.058 5.073a2.2 2.2 0 0 1-.54.29c-.997.357-2.184-.465-4.558-2.11c-.601-.416-.902-.625-1.238-.746a3 3 0 0 0-.211-.067c-.344-.092-.704-.092-1.425-.092c-2.017 0-3.025 0-3.789-.636a3 3 0 0 1-.419-.43c-.621-.79-.64-1.71-.678-3.552a14 14 0 0 1 0-.57\"/></svg>
            <input type=\"range\">
        </div>
    </div>
    <div class=\"navBottom2\">
        <div class=\"songLength\"></div>
    </div>
</nav>", "components/navBottom.html.twig", "C:\\xampp\\htdocs\\24-25_dwes_practica1_AlmarchaMartinez_Gabriel\\src\\public\\templates\\components\\navBottom.html.twig");
    }
}
