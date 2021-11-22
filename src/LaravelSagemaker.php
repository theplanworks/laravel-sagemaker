<?php

namespace ThePLAN\LaravelSagemaker;

use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use ThePLAN\LaravelSagemaker\Exceptions\LaravelSagemakerException;

class LaravelSagemaker
{
    /**
     * Initialize the Sagemaker Client
     *
     * @param \Aws\SageMakerRuntime\SageMakerRuntimeClient $client
     *
     * @return void
     */
    public function __construct(private SageMakerRuntimeClient $client)
    {
        //
    }

    public function invokeEndpoint(string $body, string $endpoint, bool $async = false)
    {
        throw_unless($body, new LaravelSagemakerException('Invocation Body is Required'));
        throw_unless($endpoint, new LaravelSagemakerException('Invocation Endpoint is Required'));

        $params = [
            'Body' => $body,
            'EndpointName' => $endpoint,
        ];

        return $async ?
            $this->client->invokeEndpointAsync($params) :
            $this->client->invokeEndpoint($params);
    }
}
