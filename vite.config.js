// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue';
//
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: 'resources/js/app.js',
//             refresh: true,
//         }),
//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
// });
//

import { defineConfig, loadEnv } from 'vite';
import { homedir } from 'os';
import { resolve } from 'path';
import fs from 'fs';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
export default ({ mode }) => {
    process.env = {...process.env, ...loadEnv(mode, process.cwd())};
    const HOSTNAME = removeHttp(process.env.VITE_APP_URL) ?? 'ia_cpuc_kol.test';
    return defineConfig({
        resolve: {
            alias: {
                '@': '/resources/js/Pages',
                'components': '/resources/js/Components',
                'composables': '/resources/js/Composables',
                'mixins': '/resources/js/Mixins',
            },
            dedupe: ['vue']
        },
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/css/dependencies.css',
                    'resources/css/style.css',
                    'resources/js/app.js',
                ],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        server: detectServerConfig(HOSTNAME),
    });
}
function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`);
    let certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`);
    if (!fs.existsSync(keyPath)) {
        return {};
    }
    if (!fs.existsSync(certificatePath)) {
        return {};
    }
    return {
        hmr: { host },
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
        origin: process.env.VITE_APP_URL
    }
}
function removeHttp(url) {
    return url.replace(/^https?:\/\//, '');
}
