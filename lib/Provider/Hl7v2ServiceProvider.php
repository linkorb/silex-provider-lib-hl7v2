<?php

namespace LinkORB\Hl7v2\Provider;

use Hl7v2\AcknowledgementGenerator;
use Hl7v2\Factory\DatagramFactory;
use Hl7v2\Factory\DataTypeFactory;
use Hl7v2\Factory\MessageFactory;
use Hl7v2\Factory\SegmentFactory;
use Hl7v2\Factory\SegmentGroupFactory;
use Hl7v2\MessageParserBuilder;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class Hl7v2ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['hl7v2.type.factory'] = function ($app) {
            return new DataTypeFactory;
        };
        $app['hl7v2.segment.factory'] = function ($app) {
            return new SegmentFactory($app['hl7v2.type.factory']);
        };
        $app['hl7v2.segment_group.factory'] = function ($app) {
            return new SegmentGroupFactory;
        };
        $app['hl7v2.message.factory'] = function ($app) {
            return new MessageFactory(
                $app['hl7v2.segment.factory'],
                $app['hl7v2.segment_group.factory']
            );
        };

        # a convenient DatagramFactory
        $app['hl7v2.datagram.factory'] = function ($app) {
            return new DatagramFactory;
        };

        # the parser service
        $app['hl7v2.parser.service'] = function ($app) {
            return (new MessageParserBuilder)
                ->withDataTypeFactory($app['hl7v2.type.factory'])
                ->withMessageFactory($app['hl7v2.message.factory'])
                ->withSegmentFactory($app['hl7v2.segment.factory'])
                ->build()
            ;
        };

        # the acknowledgement service
        $app['hl7v2.acknowledgement.service'] = function ($app) {
            return new AcknowledgementGenerator(
                $app['hl7v2.message.factory'],
                $app['hl7v2.segment.factory']
            );
        };
    }
}
