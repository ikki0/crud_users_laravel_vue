const { defineConfig } = require('@vue/cli-service');

const useHttps = process.env.USE_PORTS_HTTPS === 'true';

module.exports = defineConfig({
    transpileDependencies: true,
    publicPath: process.env.NODE_ENV === 'production'
        ? '/your-production-sub-path/'
        : '/',
    devServer: useHttps ? {
        https: true,
        client: {
            webSocketURL: {
                protocol: 'wss',
                hostname: 'localhost',
                port: 8080,
            }
        },
        historyApiFallback: true, // Redirige todas las rutas al archivo index.html
    } : {},
    configureWebpack: {
        devtool: 'source-map', // Asegúrate de que los mapas de origen estén habilitados
    },
});
