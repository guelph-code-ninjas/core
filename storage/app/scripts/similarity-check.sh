curl http://localhost:4910/check \
  -X POST \
  -d "{\"assignmentId\": \"$ASSIGNMENT_ID\",
       \"threshold\": $SIMILARITY_THRESHOLD,
       \"studentId\": \"$STUDENT_ID\",
       \"directory\": \"$SUBMISSION_DIR\",
       \"language\": \"c\"}" \
  --header "Content-Type:application/json"
