import { useBlockProps } from '@wordpress/block-editor';
import type { Attributes } from './types';

type Props = {
    attributes: Attributes;
}

export const Save = ({ attributes }: Props) => {
    const blockProps = useBlockProps.save();

    return (
        <div {...blockProps}>
            {attributes.data.map((media, index) => (
                <a
                    className="wp-block-auto-socials__link"
                    key={index}
                    href={media.link || '#'}
                    rel='noopener nofollow'
                    target='_blank'
                >
                    {media.icon && (
                        <svg>
                            <use href={`#social/${media.icon}`} />
                        </svg>
                    )}
                </a>
            ))}
        </div>
    )
}
