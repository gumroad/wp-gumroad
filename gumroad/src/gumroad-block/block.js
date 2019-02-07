/**
 * BLOCK: gumroad-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
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

const gumroadURL = 'https://gum.co/';
const defaultID = 'DviQY';

class GumControls extends Component {
  constructor( props ) {
    super( ...arguments );
  }

  compose_url( value ) {
    if (value == '') {
      return gumroadURL + defaultID;
    }
    return gumroadURL + value;
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

    const wantedOptions = [
      { value: '', label: __( 'Unwanted' )},
      { value: 'true', label: __( 'Wanted' )}
    ];

    const {
      setAttributes,
      attributes: {
        id,
        type,
        button,
        classes,
        wanted,
        url
      }
    } = this.props;

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
                setAttributes( { url: this.compose_url( value ) } );
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
          <SelectControl
            label={ __( 'Wanted?' ) }
            description={ __( 'Is this product immediately wanted?' ) }
            options={ wantedOptions }
            value={ wanted }
            onChange={ ( value ) => setAttributes( { wanted: value } ) }
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
        classes,
        wanted
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
 * Register: a Gutenberg Block.
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

    const {
      attributes: {
        id,
        type,
        classes,
        text,
        wanted,
        button,
        url
      }
    } = props;

    var urlString = '';
    urlString = url;

    if (wanted == 'true') {

      urlString = urlString + '?wanted=true';
    }

    if ( type == 'embed' ) {

      return ( // return if link behavior normal
        <div class="gumroad-product-embed" data-gumroad-product-id={"" + id + ""}></div>
      )
    } else if ( type == 'overlay' ) {

      return ( // return if link behavior normal
        <a
        href={urlString}
        className={" " + classes + " "+ button + " "}
        >
        { text && !! text.length && (
          <RichText.Content
            value={ text }
          />
        )}
        </a>
      )
    } else {

      return ( // return if link behavior normal
        <a
        href='#'
        className={" " + classes + " "+ button + " "}
        onClick={"window.open('" + urlString + "', '_blank')"}
        >
        { text && !! text.length && (
          <RichText.Content
            value={ text }
          />
        )}
        </a>
      )
    }
  },
} );
