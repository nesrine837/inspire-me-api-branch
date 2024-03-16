pipeline {
    agent any

    stages {
        stage('Check GitHub for Updates') {
            steps {
                script {
                    def latestCommit = sh(script: "git ls-remote -h https://github.com/nesrine837/inspire-me-api-branch.git HEAD | cut -f1", returnStdout: true).trim()

                    def storedCommit = readFile('latest_commit.txt').trim()

                    if (latestCommit != storedCommit) {
                        echo 'New commit detected. Proceeding with build.'
                        writeFile file: 'latest_commit.txt', text: latestCommit
                        currentBuild.result = 'SUCCESS'
                    } else {
                        echo 'No new commit detected. Skipping build.'
                        currentBuild.result = 'ABORTED'
                        return
                    }
                }
            }
        }
        stage('Checkout and Build') {
            when {
                expression {
                    currentBuild.result == 'SUCCESS'
                }
            }
            steps {
                // Checkout and build steps
                git 'https://github.com/nesrine837/inspire-me-api-branch.git'
                sh 'your_build_command_here'
            }
        }
    }
}
