pipeline {
    agent any

    environment {
        SONAR_TOKEN = credentials('jenkins-token')   // Credential Sonar
        GITHUB_TOKEN = credentials('CI-CD Token') // Credential GitHub (pull code)
        APP_DIR = '/opt/lampp/htdocs/antrian'     // Lokasi deploy XAMPP
    }

    stages {

        stage('Checkout Code') {
            steps {
                git branch: 'main',
                    credentialsId: 'github-token',
                    url: 'https://github.com/Ottapiens/antrian.git'
            }
        }

        stage('Build') {
            steps {
                echo 'Build step - Web PHP tidak perlu build'
            }
        }

        stage('SAST - SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    script {
                        def scannerHome = tool 'sonar-scanner'
                        sh """
                        ${scannerHome}/bin/sonar-scanner \
                        -Dsonar.projectKey=antrian \
                        -Dsonar.sources=. \
                        -Dsonar.php.exclusions=vendor/** \
                        -Dsonar.host.url=http://localhost:9000 \
                        -Dsonar.login=$SONAR_TOKEN
                        """
                    }
                }
            }
        }

        stage('DAST - ZAP') {
            steps {
                echo 'Menjalankan ZAP Baseline Scan...'
                sh '''
                docker run -v $(pwd):/zap/wrk/:rw --network="host" \
                owasp/zap2docker-stable zap-baseline.py -t http://localhost/antrian \
                -r zap-report.html || true
                '''
                archiveArtifacts artifacts: 'zap-report.html', fingerprint: true
            }
        }

        stage('Deploy to XAMPP') {
            steps {
                echo 'Deploying to XAMPP htdocs...'
                sh """
                sudo rm -rf ${APP_DIR}/*
                sudo cp -r * ${APP_DIR}/
                sudo chown -R www-data:www-data ${APP_DIR}
                """
            }
        }
    }

    post {
        always {
            echo 'Pipeline Selesai'
        }
        success {
            echo 'Deploy sukses ✅'
        }
        failure {
            echo 'Pipeline gagal ❌'
        }
    }
}

