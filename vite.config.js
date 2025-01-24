import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/css/user.css',
                'public/css/eng.css',
                'public/css/dash.css',
                'public/css/dashpartsuder.css',
                'public/css/tiketB.css',
                'public/css/userUpdate.css',
                'public/css/procEng.css',
                'public/css/addUser.css',
                'public/css/engDone.css',
                'public/css/addBranch.css'
                // public/css/user.css
            ],
            refresh: true,
        }),
    ],
});
