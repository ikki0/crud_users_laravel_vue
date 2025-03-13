const { defineConfig } = require('@vue/cli-service')

// RECUPERAR VALOR .ENV USE_PORTS_HTTPS PARA HABILITAR PUERTO HTTPS
const useHttps = process.env.USE_PORTS_HTTPS === 'true'

module.exports = defineConfig({
    transpileDependencies: true,
    publicPath: process.env.NODE_ENV === 'production'
        ? '/your-production-sub-path/'
        : '/',
    // Asegúrate de no tener configuraciones que forcen el uso del modo hash
    devServer: useHttps ? {
        https: true,
        client: {
            webSocketURL: {
                protocol: 'wss', // Fuerza el uso de WebSocket seguro
                hostname: 'localhost', // Ajusta el hostname según sea necesario
                port: 8080, // Asegúrate de que coincida con el puerto que usas
            }
        }
    } : {}
})
