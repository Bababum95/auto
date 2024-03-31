/**
 * External dependencies
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { ReactSVG } from 'react-svg';
import { create, closeSmall } from '@wordpress/icons';
import {
    PanelBody,
    SelectControl,
    TextControl,
    Button,
    __experimentalToggleGroupControl as ToggleGroupControl,
    __experimentalToggleGroupControlOptionIcon as ToggleGroupControlOptionIcon,
} from '@wordpress/components';
/**
 * Internal dependencies
 */
import type { Attributes } from './types';
import { icons } from './icons';
import './editor.scss';

const socials = Object.keys(icons)

type LinkProps = {
    iconName?: string;
    network: string;
}

/**
 * The Link component renders an SVG icon based on the provided iconName and network.
 * @param {LinkProps}  - The `Link` component takes two props: `iconName` and `network`. The `iconName`
 * prop is used to specify the name of the icon to be displayed, while the `network` prop is used to
 * determine which set of icons to search for the specified icon name.
 * @returns A ReactSVG component with the icon corresponding to the provided iconName and network, if
 * it exists in the icons object. If the iconName is not provided or the icon is not found, null is
 * returned.
 */
const Link = ({ iconName, network }: LinkProps) => {
    if (!iconName) return null;

    const icon = icons[network].find((icon) => icon.name === iconName).icon

    if (!icon) return null;

    return (
        <ReactSVG className="wp-block-auto-socials__link" src={icon} />
    )
}

type Props = {
    attributes: Attributes;
    setAttributes: Function;
}

export const Edit = ({ attributes, setAttributes }: Props) => {
    const blockProps = useBlockProps();

    const handleSelectChange = (value: string, index: number) => {
        const newData = [...attributes.data];
        newData[index] = { slug: value };
        setAttributes({ data: newData });
    };

    const handleChange = (value: string, index: number, key: string) => {
        const newData = [...attributes.data];
        newData[index] = { ...newData[index], [key]: value };
        setAttributes({ data: newData });
    };

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title="Socials Settings">
                    {attributes.data.map((media, index) => (
                        <div className="sidebar-item" key={index}>
                            <SelectControl
                                label="Select media"
                                value={media.slug}
                                options={[
                                    {
                                        disabled: true,
                                        label: 'Select a media',
                                        value: '0',
                                    },
                                    ...socials.map((social) => ({
                                        label: social.charAt(0).toUpperCase() + social.slice(1),
                                        value: social,
                                    }))
                                ]}
                                onChange={(value: string) => handleSelectChange(value, index)}
                            />
                            <TextControl
                                label="Link"
                                value={media.link}
                                onChange={(value: string) => handleChange(value, index, 'link')}
                            />
                            {icons.hasOwnProperty(media.slug) && (
                                <ToggleGroupControl
                                    label="Select icon"
                                    value={media.icon}
                                    onChange={(value: string) => handleChange(value, index, 'icon')}
                                >
                                    {icons[media.slug].map(({ name, icon }) => (
                                        <ToggleGroupControlOptionIcon
                                            key={name}
                                            value={name}
                                            label=''
                                            className='icon'
                                            icon={<ReactSVG src={icon} />}
                                        />
                                    ))}
                                </ToggleGroupControl>
                            )}
                            <Button
                                icon={closeSmall}
                                onClick={() => setAttributes({ data: attributes.data.filter((_, i) => i !== index) })}
                                variant='secondary'
                                className='remove-button'
                            />
                        </div>
                    ))}
                    <Button
                        icon={create}
                        onClick={() => setAttributes({ data: [...attributes.data, { slug: '0' }] })}
                        variant='primary'
                        className="add-button"
                    />
                </PanelBody>
            </InspectorControls>
            {attributes.data.map((media, index) => (
                <Link key={index} network={media.slug} iconName={media.icon} />
            ))}
        </div>
    );
};
