import React, {useState, useEffect, useRef} from 'react';
import {View, Text, StyleSheet, Alert, Button, Dimensions, TouchableHighlight} from 'react-native';
import { Audio } from 'expo-av';
import {useNavigation} from "@react-navigation/native";
import { LinearGradient } from 'expo-linear-gradient';
let musicFiles = {
    'V6 - Bad dreams': require('../assets/music/Bad_dreams(V6).mp3'),
    'Nerso_Verse - Caution': require('../assets/music/Caution(Nerso_Verse).mp3'),
    'Nerso_Verse - De_Locos': require('../assets/music/De_Locos(Nerso_Verse).mp3'),
    'Nerso_Verse - Guadalquivir': require('../assets/music/Guadalquivir(Nerso_Verse).mp3'),
    'LP - 330': require('../assets/music/330(LP).mp3'),
    'LP - ABOUTI 13': require('../assets/music/ABOUTI_13(LP).mp3'),
    'LP - bete 4': require('../assets/music/bête_4(LP).mp3'),
    'LP - BLOQUÉ 6': require('../assets/music/BLOQUÉ_6(LP).mp3'),
    'LP - BOUNCE 3': require('../assets/music/BOUNCE_3(LP).mp3'),
    'LP - BREAK': require('../assets/music/BREAK(LP).mp3'),
    'LP - CC6': require('../assets/music/CC6_(LP).mp3'),
    'LP - CHILL 8': require('../assets/music/CHILL_8(LP).mp3'),
    'LP - CVLB 3': require('../assets/music/CVLB_3(LP).mp3'),
    'LP - DARKNESS 5': require('../assets/music/DARKNESS_5(LP).mp3'),
    'LP - DOL': require('../assets/music/DOL(LP).mp3'),
    'LP - DRACE 4': require('../assets/music/DRACE_4(LP).mp3'),
    'LP - EASY 5': require('../assets/music/EASY_5(LP).mp3'),
    'LP - FEU V2': require('../assets/music/FEU_V2(LP).mp3'),
    'LP - FIVE': require('../assets/music/FIVE(LP).mp3'),
    'LP - FLU 4': require('../assets/music/FLU_4(LP).mp3'),
    'LP - FREEZE': require('../assets/music/FREEZE(LP).mp3'),
    'LP - GANG 3': require('../assets/music/GANG_3(LP).mp3'),
    'LP - GOODBYE 7': require('../assets/music/GOODBYE_7(LP).mp3'),
    'LP - HALLOWEEN': require('../assets/music/HALLOWEEN(LP).mp3'),
    'LP - head 6': require('../assets/music/head_6(LP).mp3'),
    'LP - ICI 4': require('../assets/music/ICI_4(LP).mp3'),
    'LP - INTRO VI': require('../assets/music/INTRO_VI(LP).mp3'),
    'LP - LY 8': require('../assets/music/LY_8(LP).mp3'),
    'LP - MAN 12': require('../assets/music/MAN_12(LP).mp3'),
    'LP - MOBB 3': require('../assets/music/MOBB_3(LP).mp3'),
    'LP - NG': require('../assets/music/NG(LP).mp3'),
    'LP - NM 7 BREAK': require('../assets/music/NM_7_BREAK(LP).mp3'),
    'LP - NOIR XII': require('../assets/music/NOIR_XII(LP).mp3'),
    'LP - old school freestyle': require('../assets/music/old_school_freestyle(LP).mp3'),
    'LP - OMNI 17': require('../assets/music/OMNI_17(LP).mp3'),
    'LP - P3': require('../assets/music/P3(LP).mp3'),
    'LP - PQP': require('../assets/music/PQP(LP).mp3'),
    'LP - TA11': require('../assets/music/TA11(LP).mp3'),
    'LP - TRAPEUR': require('../assets/music/TRAPEUR(LP).mp3'),
    'LP - very chill 2': require('../assets/music/very_chill_2(LP).mp3'),
    'LP - VT': require('../assets/music/VT(LP).mp3'),
    'LP - WAZINK 12': require('../assets/music/WAZINK_12(LP).mp3')
};
const {height, width} = Dimensions.get('window');

const Game = (navigation) => {
    const nav = useNavigation();

    const isMounted = useRef(true);

    useEffect(() => {
        return () => {
            isMounted.current = false;
        };
    }, []);

    const [EndGame, SetEndGame ] = useState(false)
    const [words, setWords] = useState(require('../assets/mots.json'));
    let random = Math.floor(Math.random() * words.length)
    const [currentWord, setCurrentWord] = useState(words[random]['Mot']);
    const [timeLeft, setTimeLeft] = useState(navigation.route.params.gameTime ? navigation.route.params.gameTime : 60);
    const [round, setRound] = useState(1);
    const [player, setPlayer] = useState(navigation.route.params.player1 ? navigation.route.params.player1 : "player1" );
    const [songKey, setSongKey] = useState(null);
    const [initTime, setInitTime] = useState(4);
    const [currentMusic, setCurrentMusic] = useState("");

    useEffect(() => {
        if (initTime > 0) {
            const timer = setInterval(() => {
                setInitTime(initTime - 1);
            }, 1000);
            return () => clearInterval(timer);
        }
    }, [initTime]);

    useEffect(() => {
        if (!songKey) {
            let keys = Object.keys(musicFiles);
            let randomKey = keys[ keys.length * Math.random() << 0];
            setCurrentMusic(randomKey);
            setSongKey(randomKey);
        }
    }, [songKey]);

    useEffect(() => {
        // Fetch words from JSON file
        const fetchWords = async () => {
            const response = require('../assets/mots.json');
            setWords(response);
        };
        fetchWords();
    }, []);

    useEffect(() => {
        const interval = setInterval(() => {
            if (initTime > 0) {
                setInitTime(initTime - 1);
                if(navigation.route.params.gameTime)
                    setTimeLeft(navigation.route.params.gameTime)
                else
                    setTimeLeft(60)
            }
            if (initTime === 0 && timeLeft === 0) {
                clearInterval(interval);
                if (round === 2 || round === 3) {
                    if(round < 3){
                        setRound(round + 1);
                        setInitTime(4)
                        setCurrentWord("");
                    }
                    if(round === 2){
                        SetEndGame(true);
                        Alert.alert('FIN', 'La partie est terminée');
                    }
                } else {
                    setRound(round + 1);
                    setTimeLeft(navigation.route.params.gameTime);
                    setInitTime(4); // set initTime to 3 for the next round
                    setPlayer(player === navigation.route.params.player1 ? navigation.route.params.player2 ? navigation.route.params.player2 : "player2"  : navigation.route.params.player1);
                }
            }
        }, 1000);
        return () => clearInterval(interval);
    }, [initTime, words, timeLeft, round, navigation.route.params.gameTime, navigation.route.params.player1, navigation.route.params.player2]);

    useEffect(() => {
        // Display a new word every 2 seconds
        const interval = setInterval(() => {
            if (words.length > 0) {
                if(round < 3 && initTime === 0) {
                    const randomIndex = Math.floor(Math.random() * words.length);
                    const randomWord = words[randomIndex]['Mot'];
                    setCurrentWord(randomWord);
                }
            }
        }, navigation.route.params.wordTime);
        return () => clearInterval(interval);
    }, [initTime ,words, round, navigation.route.params.wordTime]);

    // decrement the time left every second
    useEffect(() => {
        const interval = setInterval(() => {
            if (timeLeft === 0) {
                clearInterval(interval);
            } else {
                if(initTime === 0)
                    setTimeLeft(timeLeft - 1);
            }
        }, 1000);
        return () => clearInterval(interval);
    }, [initTime, timeLeft, round]);

    useEffect(() => {
        Audio.setAudioModeAsync({
            allowsRecordingIOS: false,
            staysActiveInBackground: false,
            playsInSilentModeIOS: true,
        });
    }, []);

    useEffect(() => {
        let music = new Audio.Sound();
        let isLoaded = false;

        if(round <= 2 && songKey) {
            let musicFile = musicFiles[songKey];
            music.loadAsync(musicFile, { shouldPlay: true }).then(() => {
                console.log("Sound Loaded");
                isLoaded = true;
                if(isMounted.current) music.playAsync();
            });
        }
        return () => {
            if (isLoaded) {
                music.stopAsync();
                music.unloadAsync();
            }
        }
    }, [round, isMounted.current, songKey, musicFiles]);

    const handleRematch = () => {
        nav.goBack()
    };

    return (
        <View style={styles.container}>
            <LinearGradient
                // Background Linear Gradient
                colors={['rgba(63,15,64,0.9)', 'transparent']}
                style={styles.background}
            />
            {EndGame ? (

                    <TouchableHighlight onPress={handleRematch}  style={styles.rematchButtonContainer}>
                        <Text style={styles.rematchButton}>REJOUER</Text>
                    </TouchableHighlight>

            ) : (
                <>
                    {initTime > 0 ? (
                        <Text style={styles.timer}>{initTime}</Text>
                    ) : (
                        <>
                            <View style={styles.playerContainer}>
                                <Text style={styles.player}>{player}</Text>
                            </View>
                            <View style={styles.timerContainer}>
                                <Text style={styles.timer}>{timeLeft}</Text>
                            </View>
                            <View style={styles.musicNameContainer}>
                                <Text style={styles.wordMusicName}>{currentMusic}</Text>
                            </View>
                            <View style={styles.wordContainer}>
                                <Text style={styles.word}>{currentWord}</Text>
                            </View>
                        </>
                    )}
                </>
            )}
        </View>
    );
}

export default Game;

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: "#0c030c",
        alignItems: 'center',

    },
    timerContainer: {
        alignItems: 'center',
        marginTop: 10,
        justifyContent: 'center',
    },
    timer: {
        color: 'white',
        fontSize: 50,
        marginTop: height / 12,
        marginBottom: 30,
    },
    playerContainer: {
        alignItems: 'center',
        marginTop: height / 4,
        justifyContent: 'center',
    },
    player: {
        color: 'white',
        fontSize: 20,
        marginBottom: 20,
    },
    wordContainer: {
        alignItems: 'center',
        marginTop: 50,
        justifyContent: 'center',
        borderWidth: 3,  // Ajoute une bordure d'épaisseur 1
        borderColor: 'white',  // Couleur de la bordure
        borderRadius: 25,  // Rayon des coins du rectangle
        paddingHorizontal: 25,  // Espacement horizontal à l'intérieur du conteneur
        paddingVertical: 15,  // Espacement vertical à l'intérieur du conteneur
    },
    musicNameContainer: {
        alignItems: 'center',
        marginTop: 50,
        justifyContent: 'center',
        fontSize: 10,
    },
    word: {
        color: 'white',
        fontWeight: 'bold',
        textAlign: 'center',
        fontSize: 30,
        textTransform: 'uppercase'
    },
    wordMusicName: {
        color: 'white',
        fontSize: 10,
    },
    background: {
        position: 'absolute',
        left: 0,
        right: 0,
        top: 0,
        height: 900,
    },
    rematchButton: {
        color: 'black',
        fontWeight: 'bold',
        textAlign: 'center',
        fontSize: 20
    },
    musicContainer: {
        alignItems: 'center',
        marginTop: 20,
        justifyContent: 'center',
    },
    rematchButtonContainer: {
        position: 'absolute',
        marginTop: height / 2,
        shadowColor: 'rgba(75,15,77, .4)', // IOS
        shadowOffset: {height: 10, width: 10}, // IOS
        shadowOpacity: 1, // IOS
        shadowRadius: 1, //IOS
        elevation: 1, //Android (don't work)
        width: width / 1.2,
        backgroundColor: 'yellow',
        borderRadius: 25,
        padding: 10,
        alignItems: 'center',
    }
});
