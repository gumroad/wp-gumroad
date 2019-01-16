/**
 * GumBlocks
 *
 * Widgets and blocks for the Gutenberg editor.
 *
 *
 *
 *
*/

(function( blocks, element ) {
  const el = element.createElement;
  const {TextControl} = wp.components;
  const {withState} = wp.compose;

  // import {TextControl} from '@wordpress/components';
  // import {withState} from '@wordpress/compose';

  blocks.registerBlockType( 'gumroad/gumblocks', {
    title: 'Gumroad Embed',
    icon: 'universal-access-alt',
    category: 'embed',
    attributes: {
      shortcode: {
        type: 'string',
        default: ''
      }
    },
    edit: function(props) {
      return el(
        TextControl,
        {
          onChange: (shortcode) => {
            props.setAttributes( { shortcode } )
          },
          label: 'ShortCode'
        },
        props.attributes.shortcode
      );
    },
    save: function() {
      return null;
    },
  } );

}(
	window.wp.blocks,
	window.wp.element
));
