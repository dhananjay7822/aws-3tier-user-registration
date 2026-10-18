| Security Group | Source | Port |
|---|---|---|
| WebAlbSG | 0.0.0.0/0 | 80 |
| WebEc2SG | WebAlbSG | 80 |
| AppAlbSG | WebEc2SG | 80 |
| AppEc2SG | AppAlbSG | 80 |
| DbSG | AppEc2SG | 3306 |