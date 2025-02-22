const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
    transpileDependencies: true,
    publicPath: process.env.NODE_ENV === 'production'
        ? '/your-production-sub-path/'
        : '/',
    // Asegúrate de no tener configuraciones que forcen el uso del modo hash
})
