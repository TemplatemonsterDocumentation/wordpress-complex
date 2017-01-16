<?php

namespace MPHB\Admin\Fields;

class FieldFactory {

	/**
	 *
	 * @param string $name
	 * @param array $details
	 * @param mixed $value
	 * @return \MPHB\Admin\Fields\InputField
	 */
	public static function create( $name, $details, $value = null ){
		switch ( $details['type'] ) {
			case 'text':
				return new TextField( $name, $details, $value );
				break;
			case 'number':
				return new NumberField( $name, $details, $value );
				break;
			case 'email':
				return new EmailField( $name, $details, $value );
				break;
			case 'textarea':
				return new TextareaField( $name, $details, $value );
				break;
			case 'rich-editor':
				return new RichEditorField( $name, $details, $value );
				break;
			case 'select':
				return new SelectField( $name, $details, $value );
				break;
			case 'page-select':
				return new PageSelectField( $name, $details, $value );
				break;
			case 'dynamic-select':
				return new DynamicSelectField( $name, $details, $value );
				break;
			case 'multiple-select':
				return new MultipleSelectField( $name, $details, $value );
				break;
			case 'gallery':
				return new GalleryField( $name, $details, $value );
				break;
			case 'datepicker':
				return new DatePickerField( $name, $details, $value );
				break;
			case 'timepicker':
				return new TimePickerField( $name, $details, $value );
				break;
			case 'complex':
				return new ComplexHorizontalField( $name, $details, $value );
				break;
			case 'complex-vertical':
				return new ComplexVerticalField( $name, $details, $value );
				break;
			case 'total-price':
				return new TotalPriceField( $name, $details, $value );
				break;
			case 'service-chooser':
				return new ServiceChooserField( $name, $details, $value );
				break;
			case 'checkbox':
				return new CheckboxField( $name, $details, $value );
				break;
			case 'color-picker':
				return new ColorPickerField( $name, $details, $value );
				break;
		}
		return $field;
	}

}
