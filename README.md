# ECM1417-Coursework

The files included in this repository were produced by **Miles Edwards**, to fulfill the criteria outlined in the *project specification* below. 

---

Link to Project Specification:

> https://github.com/milesmfe/ECM1417-Coursework/blob/main/ecm1417-project-spec-2022.pdf

Link to GitHub page:
> https://github.com/milesmfe/ECM1417-Coursework

Link to Tetris Site:
> http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:57601/tetris/

---

To update the files on the server, you may run the following in the server's linux terminal with sudo privilages:

`cd /var/www/html`  
`sudo rm -r ECM1417-Coursework`  
`sudo git clone https://github.com/milesmfe/ECM1417-Coursework.git`  
`sudo rm -r tetris`  
`sudo mv ECM1417-Coursework/tetris /var/www/html`  
`cd tetris`  
`ls`  
