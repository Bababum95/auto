import { resolve } from 'path';
import { defineConfig } from 'vite';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';

const MODE = process.env.NODE_ENV || 'production';

const adminDir = '/src/admin';
const frontendDir = '/src/frontend';

export default defineConfig({
	base: '/',
	build: {
		rollupOptions: {
			input: {
				main: resolve(__dirname, `${frontendDir}/index.ts`),
				styles: resolve(__dirname, `${frontendDir}/styles.scss`),
				theoryExamQuestionStyles: resolve(
					__dirname,
					'src/admin/meta-box/theory-exam-question.scss'
				),
				theoryExamQuestionScripts: resolve(
					__dirname,
					'src/admin/meta-box/theory-exam-question.ts'
				),
				'archive-questions': resolve(
					__dirname,
					`${frontendDir}/archive-questions/archive-questions.scss`
				),
			},
		},
		outDir: 'dist',
		assetsDir: 'assets',
		emptyOutDir: true,
		minify: true,
		manifest: true,
		sourcemap: MODE === 'development',
	},
	css: {
		preprocessorOptions: {
			scss: {
				additionalData:
					'@import "/src/mixins/index.scss"; @import "/src/variables/index.scss";',
			},
		},
	},
	plugins: [ViteImageOptimizer()],
});
