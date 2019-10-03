<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "حقل :attribute يجب قبوله.",
	"active_url"           => "حقل :attribute ليس رابط صحيح.",
	"after"                => "حقل :attribute يجب أن يكون تاريخ بعد :date.",
	"alpha"                => "حقل :attribute يجب أن يحتوي علي حروف فقط.",
	"alpha_dash"           => "حقل :attribute يجب أن يحتوي علي حروف وأرقام وشرطات.",
	"alpha_num"            => "حقل :attribute قد يحتوي فقط على حروف وأرقام.",
	"array"                => "حقل :attribute يجب أن يكون مصفوفة.",
	"before"               => "حقل :attribute يجب أن يكون تاريخ قبل :date.",
	"between"              => [
		"numeric" => "حقل :attribute يجب أن يكون بين :min و :max.",
		"file"    => "حقل :attribute يجب أن يكون بين :min و :max كيلوبايت.",
		"string"  => "حقل :attribute يجب أن يكون بين :min و :max حروف.",
		"array"   => "حقل :attribute يجب أن يكون بين :min و :max عناصر.",
	],
	"boolean"              => "حقل :attribute يجب أن يكون صح أو خطأ.",
	"confirmed"            => "حقل :attribute التأكيد غير صحيح.",
	"date"                 => "حقل :attribute ليس تاريخ صالح.",
	"date_format"          => "حقل :attribute لا يتوافق مع الفورمات :format.",
	"different"            => "حقل :attribute و :other يجب أن يكونوا مختلفين.",
	"digits"               => "حقل :attribute يجب أن يكون :digits أرقام.",
	"digits_between"       => "حقل :attribute يجب أن يكون بين :min و :max أرقام.",
	"email"                => "حقل :attribute يجب أن يكون بريد إلكتروني صحيح.",
	"filled"               => "حقل :attribute مطلوب.",
	"exists"               => "المختار :attribute غير صالح.",
	"image"                => "حقل :attribute يجب أن تكون صورة.",
	"in"                   => "المختار :attribute غير صالح.",
	"integer"              => "حقل :attribute يجب أن يكون رقم صحيح.",
	"ip"                   => "حقل :attribute يجب أن يكون IP صحيح.",
	"max"                  => [
		"numeric" => "حقل :attribute قد لا يكون أكبر من :max.",
		"file"    => "حقل :attribute قد لا يكون أكبر من :max كيلوبايت.",
		"string"  => "حقل :attribute قد لا يكون أكبر من :max حروف.",
		"array"   => "حقل :attribute قد لا يحتوي علي أكثر من :max عناصر.",
	],
	"mimes"                => "حقل :attribute يجب أن يكون حقل من نوع: :values.",
	"min"                  => [
		"numeric" => "حقل :attribute يجب أن يكون علي الأقل :min.",
		"file"    => "حقل :attribute يجب أن يكون علي الأقل :min كيلوبايت.",
		"string"  => "حقل :attribute يجب أن يكون علي الأقل :min حروف.",
		"array"   => "حقل :attribute يجب أن يحتوي علي الأقل :min عناصر.",
	],
	"not_in"               => "المختار :attribute غير صالح.",
	"numeric"              => "حقل :attribute يجب أن يكون رقم.",
	"regex"                => "حقل :attribute فورمات غير صالح.",
	"required"             => "حقل :attribute مطلوب.",
	"required_if"          => "حقل :attribute مطلوب عندما :other يكون :value.",
	"required_with"        => "حقل :attribute مطلوب عندما :values يكون موجود.",
	"required_with_all"    => "حقل :attribute مطلوب عندما :values يكون موجود.",
	"required_without"     => "حقل :attribute مطلوب عندما :values يكون غير موجود.",
	"required_without_all" => "حقل :attribute مطلوب عندما يكون لا شئ من :values موجودة.",
	"same"                 => "حقل :attribute و :other يجب أن يتطابقوا.",
	"size"                 => [
		"numeric" => "حقل :attribute يجب أن يكون :size.",
		"file"    => "حقل :attribute يجب أن يكون :size كيلوبايت.",
		"string"  => "حقل :attribute يجب أن يكون :size حروف.",
		"array"   => "حقل :attribute يجب أن يحتوي :size عناصر.",
	],
	"unique"               => "حقل :attribute مستخدم من قبل.",
	"url"                  => "حقل :attribute صيغته غير صحيحة.",
	"timezone"             => "حقل :attribute يجب أن تكون منطقة صحيحة.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'firstname' => [
			'required' => 'اسمك الأول مطلوب.',
			'min'	   => 'اسمك الأول يجب أن يحتوي علي الأقل علي حرفين.',
			'alpha'    => 'اسمك الأول قد يحتوي فقط على حروف.',
		],
		'lastname' => [
			'required' => 'اسمك الأخير مطلوب.',
			'min'	   => 'اسمك الأخير يجب أن يحتوي علي الأقل علي حرفين.',
			'alpha'    => 'اسمك الأخير قد يحتوي فقط على حروف.',
		],
		'profileimage' =>[
			'required' => 'صورة البروفايل الخاص بك مطلوبة.',
			'image'	   => 'يجب أن تمون صورة البروفايل ملف من نوع صورة.',
			'mimes'    => 'صورة البروفايل يجب أن تكون من النوع: jpeg, jpg, bmp, png, or gif.'
		]
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
