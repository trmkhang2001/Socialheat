<?php

use Zend\Filter\FilterInterface;
use Zend\InputFilter\CollectionInputFilter;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilterInterface;

defined('BASEPATH') or exit('No direct script access allowed');


class Quick_filter {

	/**
	 * @param array $data
	 * @param array $rules
	 * @return CollectionInputFilter|InputFilterInterface
	 */
	public static function make($data, $rules)
	{
		$factory = new Factory();
		$inputFilter = $factory->createInputFilter($rules);
		$inputFilter->setData($data);
		return $inputFilter;
	}

	public static function filter($value, $rule)
	{
		$factory = new Factory();
		$inputFilter = $factory->createInputFilter(['input' => $rule]);
		$inputFilter->setData(['input' => $value]);
		return $inputFilter->isValid() ? $inputFilter->getValue('input') : '';
	}

	public static function id($required = TRUE)
	{
		if ($required)
		{
			return [
				'required'   => TRUE,
				'filters'    => [
					['name' => 'ToInt'],
				],
				'validators' => [
					[
						'name'    => 'GreaterThan',
						'options' => [
							'min'       => 1,
							'inclusive' => TRUE,
						],
					],
				],
			];
		}

		return [
			'required'   => FALSE,
			'filters'    => [
				['name' => 'Null'],
			],
			'validators' => [
				[
					'name' => 'Digits',
				],
			],
		];
	}

//	public static function checkbox()
//	{
//		return [
//			'required'   => FALSE,
//			'filters'    => [
//				['name' => 'CheckboxFilter'],
//			]
//		];
//	}

	public static function positiveInt($required = TRUE, $greaterThan = 0)
	{
		return [
			'required'   => $required,
			'filters'    => [
				['name' => 'ToInt'],
			],
			'validators' => [
				[
					'name'    => 'GreaterThan',
					'options' => [
						'min'       => $greaterThan,
						'inclusive' => TRUE,
					],
				],
			],
		];
	}

//	public static function int()
//	{
//		return [
//			'required' => FALSE,
//			'filters'  => [
//				['name' => 'ToInt'],
//			]
//		];
//	}

	public static function percent($required = TRUE)
	{
		return [
			'required'   => $required,
			'filters'    => [
				['name' => 'ToInt'],
			],
			'validators' => [
				[
					'name'    => 'GreaterThan',
					'options' => [
						'min'       => 0,
						'inclusive' => TRUE,
					],
				],
				[
					'name'    => 'LessThan',
					'options' => [
						'max'       => 100,
						'inclusive' => TRUE,
					],
				],
			],
		];
	}

	public static function float($required = TRUE)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'Regex',
					'options' => [
						'pattern'  => '/^\d+(\.\d+)?/',
						'messages' => [
							'regexNotMatch' => 'This value should be valid numbers, or floating points numbers',
						],
					],
				],
			],
		];
	}

	public static function regex($pattern, $required = TRUE, $regexNotMatch = NULL)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'Regex',
					'options' => [
						'pattern'  => $pattern,
						'messages' => [
							'regexNotMatch' => $regexNotMatch,
						],
					],
				],
			],
		];
	}

	public static function date($required = TRUE, $format = 'Y-m-d H:i:s')
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'Date',
					'options' => [
						'format' => $format,
					],
				],
			],
		];
	}

	public static function smallText($required = TRUE)
	{
		return self::text($required, 0, 20);
	}

	public static function shortText($required = TRUE)
	{
		return self::text($required, 0, 50);
	}

	public static function text($required = TRUE, $min = 0, $max = 250)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'StringLength',
					'options' => [
						'min' => $min,
						'max' => $max,
					],
				],
			],
			'filters'    => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
			],
		];
	}

	public static function mediumText($required = TRUE)
	{
		return self::text($required, 0, 250);
	}

	public static function longText($required = TRUE)
	{
		return self::text($required, 0, 1000);
	}

	public static function link($required = TRUE)
	{
		return self::text($required, 0, 3000);
	}

	public static function html($required = TRUE)
	{
		return [
			'required' => $required,
			'filters'  => [
//				['name' => 'StringTrim'],
			],
		];
	}

	public static function email($required = TRUE, $max = 255)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'StringLength',
					'options' => [
						'max' => $max,
					],
				],
				[
					'name' => 'EmailAddress',
				],
			],
			'filters'    => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
			],
		];
	}

	public static function password($required = TRUE)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'StringLength',
					'options' => [
						'min' => 8,
					],
				],
			],
			'filters'    => [
				['name' => 'StringTrim'],
				['name' => 'StripTags'],
			],
		];
	}

	public static function required($required = TRUE)
	{
		return [
			'required' => $required,
		];
	}

	public static function options($options = [], $required = TRUE)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name'    => 'InArray',
					'options' => [
						'haystack' => $options,
					],
				],
			],
		];
	}

	public static function digits($required = TRUE)
	{
		return [
			'required'   => $required,
			'validators' => [
				[
					'name' => 'Digits',
				],
			],
		];
	}


	public static function currency($required = TRUE)
	{
		return [
			'required'   => $required, //@todo: ???? need required ?
			'validators' => [
				[
					'name' => 'Digits',
				],
			],
		];
	}

	public static function note($required = TRUE)
	{
		return self::text($required, 0, 5000);
	}

	public static function name($required = TRUE)
	{
		return self::text($required, 0, 250);
	}

	public static function code($required = TRUE)
	{
		return self::text($required, 1, 50);
	}

	public static function boolean()
	{
//		return self::options([0, 1]);
		return [
			'required'   => FALSE,
			'filters'    => [
				['name' => 'CheckboxFilter'],
			]
		];
	}
}


class CheckboxFilter implements FilterInterface {

	public function filter($value)
	{
		$value = trim($value);
		if ( ! $value)
		{
			return 0;
		}
		if (empty($value))
		{
			return 0;
		}
		return 1;
	}
}