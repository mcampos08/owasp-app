pipeline {
    agent any
    stages {
        stage('Verificar herramientas SCA') {
            steps {
                echo '🔍 Verificando Syft y Grype...'
                sh 'which syft || echo "Syft no encontrado"'
                sh 'which grype || echo "Grype no encontrado"'
                sh 'syft version || echo "Syft no disponible"'
                sh 'grype version || echo "Grype no disponible"'
            }
        }
    }
}
