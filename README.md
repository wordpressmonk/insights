# insights

Developer Instrucions:

Create a new branch for the feature assigned to it in your local repository For ex: For deleting a user, you may add a branch `delete_user_branch`

	`git branch delete_user_branch`

Check out to the newly created branch

	`git checkout delete_user_branch`

Now work on your feature. Once done, add the modified/created files and commit

	`git status`

	`git add <file_path>`

	`git commit -m "Feature delete user"`

	`git push -u origin delete_user_branch`

	
	status : shows the status of your work. 
	add : Add the changed files. Use filepath so that only required files will be added
	commit : commit the changes 
	push -u : will push your local branch to the remote and made it tracking ready.
	Report to your manager once it is ready to be merged and to test.
