<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v11/errors/string_length_error.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V11\Errors;

class StringLengthError
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
9google/ads/googleads/v11/errors/string_length_error.protogoogle.ads.googleads.v11.errors"r
StringLengthErrorEnum"Y
StringLengthError
UNSPECIFIED 
UNKNOWN	
EMPTY
	TOO_SHORT
TOO_LONGB�
#com.google.ads.googleads.v11.errorsBStringLengthErrorProtoPZEgoogle.golang.org/genproto/googleapis/ads/googleads/v11/errors;errors�GAA�Google.Ads.GoogleAds.V11.Errors�Google\\Ads\\GoogleAds\\V11\\Errors�#Google::Ads::GoogleAds::V11::Errorsbproto3'
        , true);
        static::$is_initialized = true;
    }
}

