import { resolve } from 'path';
import { defineConfig } from 'vite';

const MODE = process.env.NODE_ENV || 'production';

const adminDir = '/src/admin';
const frontendDir = '/src/frontend';

export default defineConfig({
	base: '/',
	build: {
		rollupOptions: {
			input: {
				main: resolve(__dirname, '/src/index.ts'),
				styles: resolve(__dirname, '/src/styles.scss'),
				theoryExamQuestionStyles: resolve(
					__dirname,
					`${adminDir}/meta-box/theory-exam-question.scss`
				),
				theoryExamQuestionScripts: resolve(
					__dirname,
					`${adminDir}/meta-box/theory-exam-question.ts`
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
});
