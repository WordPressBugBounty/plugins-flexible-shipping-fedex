<?php

namespace FedExVendor\WPDesk\Forms\Persistence;

use FedExVendor\Psr\Container\NotFoundExceptionInterface;
use FedExVendor\WPDesk\Forms\FieldProvider;
use FedExVendor\WPDesk\Persistence\PersistentContainer;
/**
 * Can save/load provided fields to/from PersistentContainer.
 *
 * @package WPDesk\Forms
 */
class FieldPersistenceStrategy
{
    /** @var PersistentContainer */
    private $persistence;
    public function __construct(\FedExVendor\WPDesk\Persistence\PersistentContainer $persistence)
    {
        $this->persistence = $persistence;
    }
    /** @return void */
    public function persist_fields(\FedExVendor\WPDesk\Forms\FieldProvider $fields_provider, array $data)
    {
        foreach ($fields_provider->get_fields() as $field) {
            $field_key = $field->get_name();
            if ($field->has_serializer()) {
                $this->persistence->set($field_key, $field->get_serializer()->serialize($data[$field_key]));
            } else {
                $this->persistence->set($field_key, $data[$field_key]);
            }
        }
    }
    /** @return void */
    public function load_fields(\FedExVendor\WPDesk\Forms\FieldProvider $fields_provider) : array
    {
        $data = [];
        foreach ($fields_provider->get_fields() as $field) {
            $field_key = $field->get_name();
            try {
                if ($field->has_serializer()) {
                    $data[$field_key] = $field->get_serializer()->unserialize($this->persistence->get($field_key));
                } else {
                    $data[$field_key] = $this->persistence->get($field_key);
                }
            } catch (\FedExVendor\Psr\Container\NotFoundExceptionInterface $not_found) {
                // TODO: Logger
                // LoggerFactory::get_logger()->info( "FieldPersistenceStrategy:: Field {$field_key} not found" );
            }
        }
        return $data;
    }
}
