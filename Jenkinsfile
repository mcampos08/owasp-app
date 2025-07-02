pipeline {
    agent any

    environment {
        SYFT_OUTPUT = 'sbom.json'
        GRYPE_REPORT = 'grype-report.json'
        GRYPE_SARIF = 'grype-report.sarif'
    }

    stages {
        stage('Clonar código') {
            steps {
                git url: 'https://github.com/mcampos08/owasp-app.git', branch: 'main'
            }
        }

        stage('Instalar dependencias PHP') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Generar SBOM con Syft') {
            steps {
                sh "syft dir:. -o json > ${SYFT_OUTPUT}"
            }
        }

        stage('Análisis con Grype') {
            steps {
                sh """
                    set +e
                    grype sbom:${SYFT_OUTPUT} -o json > ${GRYPE_REPORT}
                    grype sbom:${SYFT_OUTPUT} -o sarif > ${GRYPE_SARIF}
                    grype sbom:${SYFT_OUTPUT} -o table --fail-on high
                    if [ \$? -ne 0 ]; then
                        echo "❌ Vulnerabilidades altas o críticas encontradas"
                        exit 1
                    fi
                """
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '*.json', fingerprint: true
            recordIssues(tools: [ sarif(pattern: 'grype-report.sarif') ])
        }
        failure {
            echo '❌ El análisis encontró vulnerabilidades graves.'
        }
        success {
            echo '✅ Análisis completado sin vulnerabilidades críticas.'
        }
    }
}
