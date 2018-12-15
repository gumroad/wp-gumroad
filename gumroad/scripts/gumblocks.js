/**
 * GumBlocks
 *
 * Widgets and blocks for the Gutenberg editor.
 *
 *
 *
 *
*/

var el = wp.element.creatElement,
  registerBlockType = wp.blocks.registerBlockType,
  blockStyle = { backgroundColor: '#900', color: '#fff', padding: '20px' };

registerBlockType( 'gumroad/gumblocks', {
  title: 'GumBlocks Embed',
  icon: 'universal-access-alt',
  category: 'embed',
  edit: function() {
    return el( 'p', { style: blockStyle }, 'Hello editor.' );
  },
  save: function() {
    return el( 'p', { style: blockStyle }, 'Hello saved content.');
  },
} );
