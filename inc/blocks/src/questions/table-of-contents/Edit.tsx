import { useBlockProps } from '@wordpress/block-editor';

export const Edit = () => {
	return (
		<nav {...useBlockProps()}>
			<ol>
				<li>
					<span>1. Was ist hier richtig</span>
					<ol>
						<li>
							<span>
								1.1. Wähle eine oder mehrere richtige Antworten
								aus
							</span>
							<ol>
								<li>
									1.1.01-001 Was kann in Kurven zum Schleudern
									führen?
								</li>
								<li>
									1.1.01-002 Warum müssen Sie besonders
									vorsichtig sein, wenn Sie ein Ihnen
									unbekanntes Fahrzeug fahren wollen?
								</li>
								<li>
									1.1.01-003 Was kann in Kurven zum Schleudern
									führen?
								</li>
							</ol>
						</li>
					</ol>
				</li>
				<li>2. Was ist hier richtig</li>
				<li>3. Was ist hier richtig</li>
			</ol>
		</nav>
	);
};
