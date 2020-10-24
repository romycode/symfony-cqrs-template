<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Middleware;

use App\Infrastructure\UI\Http\HttpRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\SerializerInterface;

class RequestDeserializer
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function deserialize(Request $request, string $className): HttpRequest
    {
        try {
            $httpRequest = $this->serializer->deserialize($request->getContent(), $className, 'json');

            if (!$httpRequest instanceof HttpRequest) {
                throw new RequestDeserializationException(sprintf('The request object "%s" must implement "%s" interface', $className, HttpRequest::class));
            }

            return $httpRequest;
        } catch (UnexpectedValueException $exception) {
            throw new RequestDeserializationException(sprintf('Can not deserialize "%s"', $className), $exception);
        }
    }
}
