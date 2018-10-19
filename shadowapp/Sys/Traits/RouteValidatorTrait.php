<?php

namespace Shadowapp\Sys\Traits;

trait RouteValidatorTrait
{
	protected static $allowedTypes = [
      'int','string'
	];
	public static function validate( array $fields )
	{
		if (empty( $fields )) {
            echo 'Params doesnot have to be empty';
            exit;
		}

		foreach ( $fields as $pattern => $value ) {
			self::validatePattern($pattern,$value);
        }
	}

	private static function validatePattern ( $pattern, $value )
	{ 
	   $cleanPattern = self::cleanPattern( $pattern );

	   $patternArray = explode(':',$cleanPattern );
       
       if (count($patternArray) != 2 ) {
           return ;
       }

       $patternType = $patternArray[0];

       if ( !in_array($patternType,self::$allowedTypes) ) {
         $message = $patternType. ' is not correct pattern type. allowed types are '.implode(', ', self::$allowedTypes);

         throw new \Shadowapp\Sys\Exceptions\Routing\WrongUriParameterException($message);
       }
       

       switch ( $patternType ) {
         case 'string':
          if ( !ctype_alpha($value) )  {
             $message = $patternArray[1]. " have to be ".$patternType;
             throw new \Shadowapp\Sys\Exceptions\Routing\WrongUriParameterException($message);
           }
         break;

         case 'int':
           if ( !is_numeric($value) )  {
             $message = $patternArray[1]. " have to be ".$patternType;

           	  throw new \Shadowapp\Sys\Exceptions\Routing\WrongUriParameterException($message);
           }

         break;

         default:
         return ;
         break;
       }    
  
	} 

    


	protected static function containsBraces ( $endArr ) 
    {
       $contains = false;
       
       foreach ( $endArr as $endp ) {
          
          if (self::stringContainsBraces($endp)) {
             $contains = true;
             break;
          }
       }

       return $contains;
    }


	protected static function stringContainsBraces ( $endp )
    {
       if (empty($endp)) {
         return false;
       }

       return ($endp[0] == '{' && $endp[strlen($endp) - 1] == '}');
    }

	private static function cleanPattern( $pattern )
	{
       if (empty($pattern) && !is_string($pattern)) {
           return false;
       } 
       
       if ( !self::stringContainsBraces($pattern) ) {
         return false;
       }

       return substr($pattern, 1, strlen($pattern) - 2);

	}
}