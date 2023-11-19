// Rating Block for IGAVEA Game Ratings

let registerBlockType = wp.blocks.registerBlockType;
let TextControl = wp.components.TextControl;

registerBlockType('savvytheme/rating-block', {
    title: 'Game Rating',
    icon: 'awards',
    category: 'common',
    attributes: {
        interest: {
            type: 'number',
            default: 0
        },
        gameplay: {
            type: 'number',
            default: 0
        },
        atmosphere: {
            type: 'number',
            default: 0
        },
        value: {
            type: 'number',
            default: 0
        },
        enjoyment: {
            type: 'number',
            default: 0
        },
    },
    edit: function (props) {
        const { attributes, setAttributes } = props;

        let finalScore = (Number(attributes.interest)
            + Number(attributes.gameplay)
            + Number(attributes.atmosphere)
            + Number(attributes.value)
            + Number(attributes.enjoyment)) / 5;

        return wp.element.createElement('div', { className: `${props.className} rating-block-editor` },
            wp.element.createElement( 'div', { className: 'rating-block-editor-content' },
                wp.element.createElement('div', { className: 'wp-block' },
                    wp.element.createElement('div', { className: 'wp-block-editor' },
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Interest / Intrigue')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('input', {
                                    type: 'text',
                                    className: 'components-text-control__input',
                                    value: attributes.interest,
                                    onChange: (event) => setAttributes({ interest: event.target.value }),
                                }))),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Gameplay / Game Feel')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('input', {
                                    type: 'text',
                                    className: 'components-text-control__input',
                                    value: attributes.gameplay,
                                    onChange: (event) => setAttributes({ gameplay: event.target.value }),
                                }))),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Atmosphere / Aesthetics')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('input', {
                                    type: 'text',
                                    className: 'components-text-control__input',
                                    value: attributes.atmosphere,
                                    onChange: (event) => setAttributes({ atmosphere: event.target.value }),
                                }))),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Value / Was it Worth Buying?')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('input', {
                                    type: 'text',
                                    className: 'components-text-control__input',
                                    value: attributes.value,
                                    onChange: (event) => setAttributes({ value: event.target.value }),
                                }))),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Enjoyment / Entertainment')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('input', {
                                    type: 'text',
                                    className: 'components-text-control__input',
                                    value: attributes.enjoyment,
                                    onChange: (event) => setAttributes({ enjoyment: event.target.value }),
                                }))),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8' },
                                wp.element.createElement('p', null, 'Total')),
                            wp.element.createElement('div', { className: 'col-4' },
                                wp.element.createElement('p', null, finalScore
                                )))
                    )
                )
            )
        );
    },
    save: function (props) {

        let finalScore = (Number(props.attributes.interest)
                + Number(props.attributes.gameplay)
                + Number(props.attributes.atmosphere)
                + Number(props.attributes.value)
                + Number(props.attributes.enjoyment)) / 5;

        let scoreColor = null;
        if (finalScore >= 0 && finalScore < 3.3)
            scoreColor = 'post-rating-red';
        else if (finalScore > 3.4 && finalScore < 6.6)
            scoreColor = 'post-rating-yellow';
        else if (finalScore > 6.7 && finalScore <= 10)
            scoreColor = 'post-rating-green';

        return wp.element.createElement('div', { className: 'rating-block' },
                    wp.element.createElement('div', { className: 'post-rating' },
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-1 post-rating-icon' },
                                wp.element.createElement('i', { className: 'fas fa-question' })),
                            wp.element.createElement('div', { className: 'col-7 post-rating-label' },
                                wp.element.createElement('p', null, 'Interest / Intrigue' )),
                             wp.element.createElement('div', { className: 'col-4 post-rating-value' },
                                 wp.element.createElement('p', null, props.attributes.interest )),
                        ),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-1 post-rating-icon' },
                                wp.element.createElement('i', { className: 'fas fa-cog' })),
                            wp.element.createElement('div', { className: 'col-7 post-rating-label' },
                                wp.element.createElement('p', null, 'Gameplay / Game Feel' )),
                            wp.element.createElement('div', { className: 'col-4 post-rating-value' },
                                wp.element.createElement('p', null, props.attributes.gameplay )),
                        ),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-1 post-rating-icon' },
                                wp.element.createElement('i', { className: 'fas fa-globe-americas' })),
                            wp.element.createElement('div', { className: 'col-7 post-rating-label' },
                                wp.element.createElement('p', null, 'Atmosphere / Aesthetics' )),
                            wp.element.createElement('div', { className: 'col-4 post-rating-value' },
                                wp.element.createElement('p', null, props.attributes.atmosphere )),
                        ),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-1 post-rating-icon' },
                                wp.element.createElement('i', { className: 'fas fa-search-dollar' })),
                            wp.element.createElement('div', { className: 'col-7 post-rating-label' },
                                wp.element.createElement('p', null, 'Value / Was it Worth Buying?' )),
                            wp.element.createElement('div', { className: 'col-4 post-rating-value' },
                                wp.element.createElement('p', null, props.attributes.value )),
                        ),
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-1 post-rating-icon' },
                                wp.element.createElement('i', { className: 'fas fa-heart' })),
                            wp.element.createElement('div', { className: 'col-7 post-rating-label' },
                                wp.element.createElement('p', null, 'Enjoyment / Entertainment' )),
                            wp.element.createElement('div', { className: 'col-4 post-rating-value' },
                                wp.element.createElement('p', null, props.attributes.enjoyment )),
                        ),
                    ),
                    wp.element.createElement('div', { className: 'post-rating-final '},
                        wp.element.createElement('div', { className: 'row' },
                            wp.element.createElement('div', { className: 'col-8 post-rating-final-label'},
                                wp.element.createElement('p', null, 'Final Score')),
                            wp.element.createElement('div', { className: 'col-4 post-rating-final-value'},
                                wp.element.createElement('p', { className: (scoreColor ? scoreColor : '') }, finalScore))
                        )
                    )
        );
    }
});