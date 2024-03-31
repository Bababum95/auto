/**
 * External dependencies
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { postContent } from '@wordpress/icons';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import { ServerSideRenderComponent } from '@components';
import { selectUtils } from '@utils';

/**
 * Component displaying the categories as dropdown or list.
 *
 * @param {Object} props            Incoming props for the component.
 * @param {Object} props.attributes Incoming block attributes.
 * @param {Function} props.setAttributes
 */
export const Edit = ({ attributes, setAttributes }) => {
	const blockProps = useBlockProps();
	const { records, isResolving } = useEntityRecords( 'postType', 'theory-exam-question' );

	return (
		<div {...blockProps}>
			<InspectorControls>
				<PanelBody title="Question Content Settings">
					{isResolving && <p>Loading...</p>}
					{records && (
						<SelectControl
							label="Question post"
							value={attributes.postId}
							options={[
								{
									disabled: true,
									label: 'Select a post',
									value: '0',
								},
								...selectUtils.getOptions( records ),
							]}
							onChange={( value ) => setAttributes( { postId: value } )}
						/>
					)}
				</PanelBody>
			</InspectorControls>
			<ServerSideRenderComponent
				attributes={attributes}
				description={metadata.description}
				icon={postContent}
				name={metadata.name}
				title={metadata.title}
			/>
		</div>
	);
};
