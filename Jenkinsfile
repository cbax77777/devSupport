pipeline {
    agent any
    
    tools {
        dockerTool 'docker-latest'
    }
    
    stages {
        stage('Build') {
            steps {
                echo 'Building the Docker images...'
                sh 'docker-compose build'
            }
        }
        stage('Start Services') {
            steps {
                echo 'Starting the application services...'
                sh 'docker-compose up -d api db'
            }
        }
        stage('Test API') {
            steps {
                echo 'Pausing for 15 seconds to let services initialize...'
                sleep 15 
                echo 'Testing the get_tickets endpoint...'
                sh 'docker-compose exec -T api curl -f http://localhost/get_tickets.php'
                echo 'Checking if services are running...'
                sh 'docker-compose ps'
            }
        }
    }
    
    post {
        always {
            script {
                echo 'Pipeline finished. Tearing down the services...'
                sh 'docker-compose down || true'
            }
        }
    }
}
