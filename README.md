# Resolver_oi

## �ϥλ���:
- �t�X [scoreboard](https://github.com/lys0829/scoreboard_api) �ϥ�

### �B�J:
1. �ƻs```config.example.php```��P�ؿ��A�R�W��```config.php```
2. �Ncms��rank data���resolver�ؿ����U
3. �bcms��rank data�ؿ����U�s�W�@�Ӹ�Ƨ��A�R�W���Q�n��contest�W��(���W�ٱN�b```config.php```���]�w)
4. �N```cms/contest/contest.json```��J3���s�W����Ƨ��A�ó]�w�n���ɦW��
5. �N��cms����Ʃ�J3���s�W����Ƨ�
6. �ק�```config.php```
7. ��bash����```cms_to_scoreboard.php```(��X���T���i����)
8. ��bash����```output_to_resolver.php```
9. �}���s�����A���}:```[host]/resolver/index.php/[class]/[contest]```
10. ���ť���K�|�}�lresolver

### config.php�]�w

OPTION | ����
---|---
$_config['sitedir'] |�����ؿ��W��(***�e��O�o�[```/```*** e.x:```/resolver/```)
$_config['class'] |class���W��(�]�N�Oscoreboard data��Ƨ����W��)
$_config['contest'] |contest���W��(�@��class�i��J�h��contest)
$_config['start_time'] |�v�ɶ}�l�ɶ��A���ɶ��|�M�w�O���O���p��(UNIX time)
$_config['end_time'] |�v�ɵ����ɶ��A���ɶ��|�M�w�O���O���p��(UNIX time)
$_config['freeze_time'] |�O���O�ᵲ�ɶ��Aresolver�|�N���ɶ����᪺�Ҧ��W�ǳ]��pending(UNIX time)
