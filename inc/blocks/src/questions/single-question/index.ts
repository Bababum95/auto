import { registerBlockType } from '@wordpress/blocks';
import { postContent } from '@wordpress/icons';
import metadata from './block.json';
import { Edit } from './edit';
import './style.scss';

registerBlockType(metadata.name, {
	...metadata as any,
	icon: {
		src: postContent,
	},
	edit: Edit,
	save: () => null,
});
