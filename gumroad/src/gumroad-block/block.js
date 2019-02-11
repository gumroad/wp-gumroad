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
  PanelBody,
  CheckboxControl
} = wp.components

const gumroadURL = 'https://gumroad.com/l/demo';
const defaultID = 'demo';
const gumroadURLRegex = /(https:\/\/gumroad\.com\/l\/)|(https:\/\/gumroad\.com\/)|(https:\/\/gum\.co\/l\/)|(https:\/\/gum\.co\/)/g;

class GumControls extends Component {
  constructor( props ) {
    super( ...arguments );
  }

  extract_id( value ) {
      var id = value.replace(gumroadURLRegex, '');
      console.log('id: ', id);
      return id;
    }

  render() {

    const typeOptions = [
      { value: 'none', label: __( 'Inline link (anchor tag)' )},
      { value: 'overlay', label: __( 'Overlay' )},
      { value: 'embed', label: __( 'Embed' )}
    ];

    const {
      setAttributes,
      attributes: {
        id,
        type,
        button,
        classes,
        wanted,
        url,
        disabled
      }
    } = this.props;

    return(
      <InspectorControls key="GumControls">
        <PanelBody>
          <label>Product URL:</label>
          <RichText
            tagName="div"
            placeholder={ __( gumroadURL ) }
            value={ url }
            onChange={ ( value ) => {
                setAttributes( { url: value } );
                setAttributes( { id: this.extract_id( value ) } );
              }
            }
          /><br />
          <SelectControl
            label={ __( 'Behavior' ) }
            description={ __( 'Set the type of Gumroad link behavior: Link, Overlay, or Embed.' ) }
            options={ typeOptions }
            value={ type }
            onChange={ ( value ) => {
                setAttributes( { type: value } );
                if ( value == 'embed') {
                  setAttributes( { disabled: 'disabled-gumbox' } );
                } else {
                  setAttributes( { disabled: 'enabled' } );
                }
              }
            }
            />
          <CheckboxControl
            label="Display as Gumroad button"
            checked={ button }
            className={ disabled }
            onChange={ ( value ) => setAttributes( { button: value } ) }
            />
          <CheckboxControl
            label="Auto-trigger the payment form"
            checked={ wanted }
            className={ disabled }
            onChange={ ( value ) => setAttributes( { wanted: value } ) }
            />
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
        wanted,
        disabled
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

    var urlString = url, wantedString = '', classesString = classes;

    // Wanted
    if (wanted == 'true' || wanted == true) {
      wantedString = '?wanted=true';
    }
    urlString = urlString + wantedString;

    // Button
    if (button == 'true' || button == true) {
      classesString = classes + ' gumroad-button';
    }

    if ( type == 'embed' ) {

      return ( // return if link behavior normal
        <div class="gumroad-product-embed" data-gumroad-product-id={"" + id + ""}></div>
      )
    } else if ( type == 'overlay' ) { // overlay links

      return (
        <a
        href={urlString}
        className={ classesString }
        >
        { text && !! text.length && (
          <RichText.Content
            value={ text }
          />
        )}
        </a>
      )
    } else { // normal links

      return (
        <a
        href='#'
        className={ classesString }
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
