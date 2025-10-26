pipeline {
    agent any

    stages {
        stage('Checkout Code') {
            steps {
                checkout scm
            }
        }

        stage('Deploy to Kali Linux') {
            steps {
                sshagent(credentials: ['kali-ssh']) {
                    sh '''
                    ssh -o StrictHostKeyChecking=no ottapien@192.168.18.60 "
                        cd /opt/lampp/htdocs/antrian &&
                        git pull origin main &&
                        sudo /opt/lampp/lampp restart
                    "
                    '''
                }
            }
        }

        stage('Run ZAP DAST') {
            steps {
                sshagent(credentials: ['kali-ssh']) {
                    sh '''
                    ssh -o StrictHostKeyChecking=no ottapien@192.168.18.60 "
                        cd /home/ottapien &&
                        sudo docker run -t --network=\\"host\\" \
                        -v \$(pwd):/zap/wrk/:rw \
                        ghcr.io/zaproxy/zaproxy:weekly zap-baseline.py \
                        -t http://localhost/antrian \
                        -r zap_report.html
                    "
                    '''
                }
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: '**/zap_report.html', allowEmptyArchive: true
        }
    }
}
