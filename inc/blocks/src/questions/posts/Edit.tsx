import { useBlockProps } from '@wordpress/block-editor';
import ContentLoader from 'react-content-loader';

export const Edit = () => {
	return (
		<div {...useBlockProps()}>
			<div>
				<span>Вопрос: 1.2.17-001</span>
				<span>4 балла</span>
			</div>
			<ContentLoader
				width={'100%'}
				height={429}
				backgroundColor="#F5F5F5"
				foregroundColor="#C4C4C4"
				speed={4}
			>
				<rect x="0" y="0" rx="10" ry="10" width="100%" height="400" />
			</ContentLoader>
		</div>
	);
};
