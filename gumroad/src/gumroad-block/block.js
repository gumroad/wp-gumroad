/**
 * BLOCK: gumroad-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './style.scss';
import './editor.scss';

const { __ } = wp.i18n; // Import __() from wp.i18n
const { Component } = wp.element;
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const {
  InspectorControls,
  RichText
} = wp.editor;

const {
  SelectControl,
  PanelBody
} = wp.components

const gumURL = 'https://gum.co/';
const defaultID = 'DviQY';

class GumControls extends Component {
  constructor( props ) {
    super( ...arguments );
  }

  compose_url( props ) {
    if (props.attributes.id == defaultID) {
      return gumURL + defaultID;
    }
    return gumURL + props.attributes.id;
  }

  render() {
    const typeOptions = [
      { value: 'none', label: __( 'Link' )},
      { value: 'overlay', label: __( 'Overlay' )},
      { value: 'embed', label: __( 'Embed' )}
    ];

    const buttonOptions = [
      { value: '', label: __( 'Link' )},
      { value: 'gumroad-button', label: __( 'Button' )}
    ];

    const { setAttributes, attributes: { id, type, button, classes, url } } = this.props;

    return(
      <InspectorControls key="GumControls">
        <PanelBody>
          <label>Product ID:</label>
          <RichText
            tagName="div"
            placeholder={ __( defaultID ) }
            value={ id }
            onChange={ ( value ) => {
                setAttributes( { id: value } );
                var url = this.compose_url( this.props );
                setAttributes( { url: url } );
                console.log( 'url: ' + url );
              }
            }
          /><br />
          <SelectControl
            label={ __( 'Behavior Type' ) }
            description={ __( 'Set the type of Gumroad link behavior: Link, Overlay, or Embed.' ) }
            options={ typeOptions }
            value={ type }
            onChange={ ( value ) => setAttributes( { type: value } ) }
            />
          <SelectControl
            label={ __( 'Button?' ) }
            description={ __( 'Make the link a button.' ) }
            options={ buttonOptions }
            value={ button }
            onChange={ ( value ) => setAttributes( { button: value } ) }
            />
          <label>Classes:</label>
          <RichText
            tagName="div"
            placeholder={ __( 'Add extra classes to your link.' ) }
            value={ classes }
            onChange={ ( value ) => setAttributes( { classes: value } ) }
          /><br />
        </PanelBody>
      </InspectorControls>
    );
  }
};

class EditBlockContent extends Component {
  render() {
    const {
      attributes: {
        id,
        text,
        type,
        url,
        button,
        classes
      },
      setAttributes
    } = this.props;

    return[
      <GumControls { ...{setAttributes, ...this.props } } />,
      <div id="gumroad-block" className="gumroad-block">
        <RichText
          tagName="div"
          placeholder={ __( 'I want this!' ) }
          keepPlaceholderOnFocus
          className="gumroad-block-link"
          value={ text }
          onChange={ ( value ) => setAttributes( { text: value } ) }
        />
      </div>
    ];
  }
};

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'gumroad/gumroad-block', {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Gumroad Block' ), // Block title.
	icon: 'shield', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__( 'gumroad-block' ),
	],
  attributes : {
    id: {
      type: 'string',
      default: ''
    },
    type: {
      type: 'string',
      default: 'none'
    },
    classes: {
      type: 'string',
      default: ''
    },
    text: {
      type: 'string',
      default: 'I want this!'
    },
    wanted: {
      type: 'string',
      default: ''
    },
    button: {
      type: 'string',
      default: 'false'
    },
    url: {
      type: 'string',
      default: ''
    }
  },

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: EditBlockContent,

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function( props ) {
    const { attributes: { id, type, classes, text, wanted, button, url }} = props;

		return (
        <a href={url} className={button} className={classes}>
        { text && !! text.length && (
          <RichText.Content
            value={ text }
          />
        )}
        </a>
		);
	},
} );
