<?php

namespace App\Ai\Agents\Personal;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Stringable;

class BloodPressureMeasurementAgent implements Agent, Conversational, HasTools, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'Eres un agente encargado de registrar las mediciones de presión arterial de un usuario. Vas a procesar un texto que contiene la información de una medición de presión arterial, y debes extraer los valores de presión sistólica, presión diastólica y pulso.';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }

    /**
     * Get the agent's structured output schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'systolic' => $schema->integer()->required()->description('La presión sistólica medida'),
            'diastolic' => $schema->integer()->required()->description('La presión diastólica medida'),
            'heart_rate' => $schema->integer()->required()->description('La frecuencia cardíaca medida'),
        ];
    }
}
