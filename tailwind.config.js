module.exports = {
    content: [
        './resources/**/*.{js,jsx,ts,tsx,vue,blade.php}',
    ],
    theme: {
        extend: {
            colors: {
                'primary': {
                    100: '#DCDEFE',
                    600: '#5139EF',
                    900: '#3521B5',
                },
                'primary-paint': {
                    300: '#F3F5F7',
                },
            },
        },
    },
    plugins: [],
};
