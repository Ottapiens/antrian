pipeline {
    agent any
    
    stages {
        stage('Checkout Code') {
            steps {
                git url: 'https://github.com/Ottapiens/antrian.git', branch: 'main'
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
                    sh "sonar-scanner -Dsonar.projectKey=antrian -Dsonar.sources=."
                }
            }
        }

        stage('DAST - ZAP') {
            steps {
                echo 'DAST step - ZAP scan akan ditambahkan setelah ini'
            }
        }

        stage('Deploy to XAMPP') {
            steps {
                echo 'Deploy step - aplikasi sudah berjalan di /opt/lampp/htdocs/antrian'
            }
        }
    }
}

