<?php

namespace ThePLAN\LaravelSagemaker;

use Aws\SageMakerRuntime\SageMakerRuntimeClient;
use Illuminate\Support\Arr;
use ThePLAN\LaravelSagemaker\Exceptions\LaravelSagemakerException;

class LaravelSagemaker
{
    /**
     * Inference Endpoint Name
     */
    protected $endpoint;

    /**
     * Body
     */
    protected $body;

    /**
     * Asyncronous Request
     */
    protected $isAsync = false;

    /**
     * Content Type for request
     */
    protected $contentType = 'application/json';

    /**
     * Target Container for request
     */
    protected $targetContainer = null;

    public static function make(string $keyID = null, string $secret = null)
    {
        $config = [
            'region' => config('sagemaker.region'),
            'version' => config('sagemaker.version'),
        ];

        $credentials = ! empty($keyID) && ! empty($secret)
            ? ['key' => $keyID, 'secret' => $secret]
            : config('sagemaker.credentials');

        if (! empty($credentials['key']) && ! empty($credentials['secret'])) {
            $config['credentials'] = Arr::only($credentials, ['key', 'secret', 'token']);
        }

        return new static(new SageMakerRuntimeClient($config));
    }

    /**
     * Initialize the Sagemaker Client
     *
     * @param  \Aws\SageMakerRuntime\SageMakerRuntimeClient  $client
     * @return void
     */
    public function __construct(private SageMakerRuntimeClient $client)
    {
        //
    }

    /**
     * Start a SageMaker session
     *
     * @param  string  $endpoint
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function forEndpoint(string $endpoint): LaravelSagemaker
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Add Message Body
     *
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function body(mixed $body): LaravelSagemaker
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Set Asyncronous
     *
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function async(): LaravelSagemaker
    {
        $this->isAsync = true;

        return $this;
    }

    /**
     * Set Content Type
     *
     * @param  string  $contentType
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function contentType(string $contentType): LaravelSagemaker
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Set Target Container
     *
     * @param  string  $targetContainer
     * @return \ThePLAN\LaravelSagemaker\LaravelSagemaker
     */
    public function targetContainer(string|null $targetContainer): LaravelSagemaker
    {
        $this->targetContainer = $targetContainer;

        return $this;
    }

    /**
     * Invoke a Sagemaker Endpoint
     *
     * @return \Aws\Result|\Guzzlehttp\Promise\Promise
     */
    public function invoke()
    {
        throw_unless($this->body, new LaravelSagemakerException('Invocation Body is Required'));
        throw_unless($this->endpoint, new LaravelSagemakerException('Invocation Endpoint is Required'));

        $params = [
            'Body' => $this->body,
            'ContentType' => $this->contentType,
            'EndpointName' => $this->endpoint,
        ];

        if ($this->targetContainer) {
            $params['TargetContainerHostname'] = $this->targetContainer;
        }


        return $this->isAsync ?
            $this->client->invokeEndpointAsync($params) :
            $this->client->invokeEndpoint($params);
    }
}
